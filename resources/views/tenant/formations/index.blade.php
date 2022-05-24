@extends('layouts.tenant')
@section('content')


    <div class="row mb-3">
        <div class="col-lg-12 d-flex justify-content-end">

            <a class="btn btn-secondary mx-2" data-toggle="collapse" href="#filterCard" role="button" aria-expanded="false"
                aria-controls="filterCard">
                {{ __('Filter') }}
                
            </a>
            @can('formation_create')
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#createFormationCanva"
                    aria-controls="createFormationCanva">{{ trans('global.add') }}
                    {{ trans('cruds.formation.title_singular') }}
                </button>
            @endcan
        </div>
    </div>




    <div class="card mt-2 collapse mb-3  @if (request('filter')) show @endif" id="filterCard">
        <div class="card-header">
            {{ __('Filter formation') }}
        </div>
        <div class="card-body">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="filter[title]" id="title"
                                value="{{ request('filter.title', '') }}" aria-describedby="helpId"
                                placeholder="{{ __('Title') }}">
                        </div>
                    </div>


                </div>
                <div class="row d-felx justify-content-end">
                    <div class="col-md-4 d-flex justify-content-end">
                        @if (request('filter'))
                            <a class="btn btn-secondary mx-2" href="{{ route('tenant.formations.index') }}"> <i
                                    class="fa fa-trash"></i> {{ __('Clear filter') }} </a>
                        @endif
                        <button type="submit" id="filter" class="btn btn-primary">{{ __('Filter') }}</button>
                    </div>

                </div>
            </form>
        </div>

    </div>

    <div class="row mb-3">
        @if($formations->count()==0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>
                    {{__('No formation available')}}
            </strong> 
            </div>
            
            <script>
              $(".alert").alert();
            </script>
        @endif
       
       
        @foreach ($formations as $formation)
        @if($formation!=null)
            <div class="col-sm-12  col-md-4">
        
                <div class="card">
                    <a href="{{ route('tenant.formations.show', ['formation' => 1]) }}">
                        <img src="{{ $formation->featured_image_url }}" class="card-img-top"
                            alt="{{ $formation->title }}" style="width: 100%;
                            aspect-ratio: 16 / 9;
                            object-fit: cover;">
                    </a>

                    <div class="card-body">
                        <div class="card-title">
                            <a class="text-decoration-none"
                                href="{{ route('tenant.formations.show', ['formation' => 1]) }}">
                                {{ $formation->title }}
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mx-1"> <i class="fa fa-timer"></i><span
                                    class="badge bg-primary ">{{ $formation->duration }}
                                    {{ $formation->duration_type }} </span> </div>
                            <div class="col-sm-6 mx-1"> <span class="badge bg-primary">
                                    {{ $formation->price_formatted }} </span> </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex gap-1">
                            <a href="{{ route('tenant.formations.destroy', ['formation' => 1]) }}"
                                class="btn btn-clean btn-sm"> <i class="fa fa-trash"></i> </a>
                            <a href="{{ route('tenant.formations.edit', ['formation' => 1]) }}"
                                class="btn btn-sm btn-clean"> <i class="fa fa-edit"></i> </a>
                        </div>
                    </div>
                </div>

            </div>
        @endif
        @endforeach
        
    </div>
@endsection
@section('canvas')
    @include('tenant.formations.offcanvas.create')
@endsection

@section('scripts')


    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('formation_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('tenant.formations.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.slug
                });
            
                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')
            
                return
                }
            
                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('tenant.formations.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            };
            let table = $('.datatable-Formation').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>


{{-- Adding create script --}}
<script>
    $(document).ready(function() {
        function SimpleUploadAdapter(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                return {
                    upload: function() {
                        return loader.file
                            .then(function(file) {
                                return new Promise(function(resolve, reject) {
                                    // Init request
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST',
                                        '{{ route('tenant.formations.storeCKEditorImages') }}',
                                        true);
                                    xhr.setRequestHeader('x-csrf-token', window._token);
                                    xhr.setRequestHeader('Accept', 'application/json');
                                    xhr.responseType = 'json';

                                    // Init listeners
                                    var genericErrorText =
                                        `Couldn't upload file: ${ file.name }.`;
                                    xhr.addEventListener('error', function() {
                                        reject(genericErrorText)
                                    });
                                    xhr.addEventListener('abort', function() {
                                        reject()
                                    });
                                    xhr.addEventListener('load', function() {
                                        var response = xhr.response;

                                        if (!response || xhr.status !== 201) {
                                            return reject(response && response
                                                .message ?
                                                `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                            );
                                        }

                                        $('form').append(
                                            '<input type="hidden" name="ck-media[]" value="' +
                                            response.id + '">');

                                        resolve({
                                            default: response.url
                                        });
                                    });

                                    if (xhr.upload) {
                                        xhr.upload.addEventListener('progress', function(
                                            e) {
                                            if (e.lengthComputable) {
                                                loader.uploadTotal = e.total;
                                                loader.uploaded = e.loaded;
                                            }
                                        });
                                    }

                                    // Send request
                                    var data = new FormData();
                                    data.append('upload', file);
                                    data.append('crud_id', '{{ $formation->id ?? 0 }}');
                                    xhr.send(data);
                                });
                            })
                    }
                };
            }
        }

        var allEditors = document.querySelectorAll('.ckeditor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(
                allEditors[i], {
                    extraPlugins: [SimpleUploadAdapter]
                }
            );
        }
    });
</script>

<script>
    Dropzone.options.featuredImageDropzone = {
        url: '{{ route('tenant.formations.storeMedia') }}',
        maxFilesize: 5, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 5,
            width: 4096,
            height: 4096
        },
        success: function(file, response) {

            $('form').find('input[name="featured_image"]').remove()
            $('form').append('<input type="hidden" name="featured_image" value="' + response.name + '">')
        },
        removedfile: function(file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="featured_image"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function() {
            // @if (isset($formation) && $formation->featured_image)
            //     var file = {!! json_encode($formation->featured_image) !!}
            //     this.options.addedfile.call(this, file)
            //     this.options.thumbnail.call(this, file, file.preview)
            //     file.previewElement.classList.add('dz-complete')
            //     $('form').append('<input type="hidden" name="featured_image" value="' + file.file_name + '">')
            //     this.options.maxFiles = this.options.maxFiles - 1
            // @endif

        },
        error: function(file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
<script>
    var uploadedSyllabusMap = {}
    Dropzone.options.syllabusDropzone = {
        url: '{{ route('tenant.formations.storeMedia') }}',
        maxFilesize: 50, // MB
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 50
        },
        success: function(file, response) {
            $('form').append('<input type="hidden" name="syllabus[]" value="' + response.name + '">')
            uploadedSyllabusMap[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedSyllabusMap[file.name]
            }
            $('form').find('input[name="syllabus[]"][value="' + name + '"]').remove()
        },
        init: function() {
            // @if (isset($formation) && $formation->syllabus)
            //     var files =
            //     {!! json_encode($formation->syllabus) !!}
            //     for (var i in files) {
            //     var file = files[i]
            //     this.options.addedfile.call(this, file)
            //     file.previewElement.classList.add('dz-complete')
            //     $('form').append('<input type="hidden" name="syllabus[]" value="' + file.file_name + '">')
            //     }
            // @endif
        },
        error: function(file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
{{-- End create scripts --}}
@endsection
