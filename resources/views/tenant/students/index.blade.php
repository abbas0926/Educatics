@extends('layouts.tenant')
@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-end">

            <a class="btn btn-secondary mx-2" data-toggle="collapse" href="#filterCard" role="button" aria-expanded="false"
                aria-controls="filterCard">
                {{ __('Filter') }}
            </a>
            @can('student_create')
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#createStudentCanva"
                    aria-controls="createStudentCanva">{{ trans('global.add') }} {{ trans('cruds.student.title_singular') }}
                </button>
            @endcan
        </div>
    </div>




    <div class="card mt-2 collapse  @if (request('filter')) show @endif" id="filterCard">
        <div class="card-header">
            {{ __('Filter students') }}
        </div>
        <div class="card-body">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="filter[first_name]" id="first_name"
                                value="{{ request('filter.first_name', '') }}" aria-describedby="helpId"
                                placeholder="{{ __('First name') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="filter[last_name]" id="last_name"
                                value="{{ request('filter.last_name', '') }}" aria-describedby="helpId"
                                placeholder="{{ __('Last name') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="phone" class="form-control" name="filter[phone]" id="phone"
                                value="{{ request('filter.phone', '') }}" aria-describedby="helpId"
                                placeholder="{{ __('Phone number') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="email" class="form-control" name="filter[email]" id="email"
                                value="{{ request('Email', '') }}" aria-describedby="helpId" placeholder="Email">
                        </div>
                    </div>

                </div>
                <div class="row d-felx justify-content-end">
                    <div class="col-md-3 d-grid gap-2">
                        <button type="submit" id="filter" class="btn btn-primary">{{ __('Filter') }}</button>
                    </div>

                </div>
            </form>
        </div>

    </div>






    <div class="row row-cols-md-4">
        @foreach ($students as $student)
            <a href="{{ route('tenant.students.show', ['student' => $student]) }}">
                <div class="card">
                    <div class="card-header ">
                        <img src="{{ $student->photo_url }}" class="img-fluid rounded-circle" alt="Student image">
                    </div>
                    <div class="card-header">
                        {{ $student->full_name }}
                    </div>

                </div>
            </a>
        @endforeach
    </div>
@endsection

@section('canvas')
    @include('tenant.students.offcanvas.create')
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('student_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('tenant.students.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.id
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
                ajax: "{{ route('tenant.students.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                        sortable: false,
                        searchable: false
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
            let table = $('.datatable-Student').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
@endsection
