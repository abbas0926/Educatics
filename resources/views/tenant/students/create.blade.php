@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.student.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.students.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="attachements">{{ trans('cruds.student.fields.attachements') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachements') ? 'is-invalid' : '' }}" id="attachements-dropzone">
                </div>
                @if($errors->has('attachements'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attachements') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.attachements_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="first_name">{{ trans('cruds.student.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}">
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_name">{{ trans('cruds.student.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}">
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.student.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="birthdate">{{ trans('cruds.student.fields.birthdate') }}</label>
                <input class="form-control date {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" type="text" name="birthdate" id="birthdate" value="{{ old('birthdate') }}">
                @if($errors->has('birthdate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birthdate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.birthdate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="adresse">{{ trans('cruds.student.fields.adresse') }}</label>
                <input class="form-control {{ $errors->has('adresse') ? 'is-invalid' : '' }}" type="text" name="adresse" id="adresse" value="{{ old('adresse', '') }}">
                @if($errors->has('adresse'))
                    <div class="invalid-feedback">
                        {{ $errors->first('adresse') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.adresse_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="study_level">{{ trans('cruds.student.fields.study_level') }}</label>
                <input class="form-control {{ $errors->has('study_level') ? 'is-invalid' : '' }}" type="text" name="study_level" id="study_level" value="{{ old('study_level', '') }}">
                @if($errors->has('study_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('study_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.study_level_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="establishement">{{ trans('cruds.student.fields.establishement') }}</label>
                <input class="form-control {{ $errors->has('establishement') ? 'is-invalid' : '' }}" type="text" name="establishement" id="establishement" value="{{ old('establishement', '') }}">
                @if($errors->has('establishement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('establishement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.establishement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.student.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="matricule">{{ trans('cruds.student.fields.matricule') }}</label>
                <input class="form-control {{ $errors->has('matricule') ? 'is-invalid' : '' }}" type="text" name="matricule" id="matricule" value="{{ old('matricule', '') }}">
                @if($errors->has('matricule'))
                    <div class="invalid-feedback">
                        {{ $errors->first('matricule') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.matricule_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    var uploadedAttachementsMap = {}
Dropzone.options.attachementsDropzone = {
    url: '{{ route('tenant.students.storeMedia') }}',
    maxFilesize: 50, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachements[]" value="' + response.name + '">')
      uploadedAttachementsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachementsMap[file.name]
      }
      $('form').find('input[name="attachements[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($student) && $student->attachements)
          var files =
            {!! json_encode($student->attachements) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="attachements[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
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
    Dropzone.options.photoDropzone = {
    url: '{{ route('tenant.students.storeMedia') }}',
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
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($student) && $student->photo)
      var file = {!! json_encode($student->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
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
@endsection