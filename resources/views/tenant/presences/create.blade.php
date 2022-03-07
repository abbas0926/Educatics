@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lesson.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.lessons.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="group_id">{{ trans('cruds.lesson.fields.group') }}</label>
                <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id" required>
                    @foreach($groups as $id => $entry)
                        <option value="{{ $id }}" {{ old('group_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.group_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="teacher_id">{{ trans('cruds.lesson.fields.teacher') }}</label>
                <select class="form-control select2 {{ $errors->has('teacher') ? 'is-invalid' : '' }}" name="teacher_id" id="teacher_id" required>
                    @foreach($teachers as $id => $entry)
                        <option value="{{ $id }}" {{ old('teacher_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('teacher'))
                    <div class="invalid-feedback">
                        {{ $errors->first('teacher') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.teacher_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_at">{{ trans('cruds.lesson.fields.start_at') }}</label>
                <input class="form-control datetime {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="text" name="start_at" id="start_at" value="{{ old('start_at') }}" required>
                @if($errors->has('start_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.start_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ends_at">{{ trans('cruds.lesson.fields.ends_at') }}</label>
                <input class="form-control datetime {{ $errors->has('ends_at') ? 'is-invalid' : '' }}" type="text" name="ends_at" id="ends_at" value="{{ old('ends_at') }}" required>
                @if($errors->has('ends_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ends_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.ends_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="classroom_id">{{ trans('cruds.lesson.fields.classroom') }}</label>
                <select class="form-control select2 {{ $errors->has('classroom') ? 'is-invalid' : '' }}" name="classroom_id" id="classroom_id" required>
                    @foreach($classrooms as $id => $entry)
                        <option value="{{ $id }}" {{ old('classroom_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('classroom'))
                    <div class="invalid-feedback">
                        {{ $errors->first('classroom') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.classroom_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('done') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="done" value="0">
                    <input class="form-check-input" type="checkbox" name="done" id="done" value="1" {{ old('done', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="done">{{ trans('cruds.lesson.fields.done') }}</label>
                </div>
                @if($errors->has('done'))
                    <div class="invalid-feedback">
                        {{ $errors->first('done') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.done_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="support">{{ trans('cruds.lesson.fields.support') }}</label>
                <div class="needsclick dropzone {{ $errors->has('support') ? 'is-invalid' : '' }}" id="support-dropzone">
                </div>
                @if($errors->has('support'))
                    <div class="invalid-feedback">
                        {{ $errors->first('support') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.support_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="homework">{{ trans('cruds.lesson.fields.homework') }}</label>
                <div class="needsclick dropzone {{ $errors->has('homework') ? 'is-invalid' : '' }}" id="homework-dropzone">
                </div>
                @if($errors->has('homework'))
                    <div class="invalid-feedback">
                        {{ $errors->first('homework') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.homework_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="presence_students">{{ trans('cruds.lesson.fields.presence_student') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('presence_students') ? 'is-invalid' : '' }}" name="presence_students[]" id="presence_students" multiple>
                    @foreach($presence_students as $id => $presence_student)
                        <option value="{{ $id }}" {{ in_array($id, old('presence_students', [])) ? 'selected' : '' }}>{{ $presence_student }}</option>
                    @endforeach
                </select>
                @if($errors->has('presence_students'))
                    <div class="invalid-feedback">
                        {{ $errors->first('presence_students') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.presence_student_helper') }}</span>
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
    var uploadedSupportMap = {}
Dropzone.options.supportDropzone = {
    url: '{{ route('tenant.lessons.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="support[]" value="' + response.name + '">')
      uploadedSupportMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSupportMap[file.name]
      }
      $('form').find('input[name="support[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lesson) && $lesson->support)
          var files =
            {!! json_encode($lesson->support) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="support[]" value="' + file.file_name + '">')
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
    var uploadedHomeworkMap = {}
Dropzone.options.homeworkDropzone = {
    url: '{{ route('tenant.lessons.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="homework[]" value="' + response.name + '">')
      uploadedHomeworkMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedHomeworkMap[file.name]
      }
      $('form').find('input[name="homework[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lesson) && $lesson->homework)
          var files =
            {!! json_encode($lesson->homework) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="homework[]" value="' + file.file_name + '">')
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
@endsection