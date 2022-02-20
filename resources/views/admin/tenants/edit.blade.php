@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tenant.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tenants.update", [$tenant->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="store_name">{{ trans('cruds.tenant.fields.store_name') }}</label>
                <input class="form-control {{ $errors->has('store_name') ? 'is-invalid' : '' }}" type="text" name="store_name" id="store_name" value="{{ old('store_name', $tenant->store_name) }}">
                @if($errors->has('store_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tenant.fields.store_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="store_logo">{{ trans('cruds.tenant.fields.store_logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('store_logo') ? 'is-invalid' : '' }}" id="store_logo-dropzone">
                </div>
                @if($errors->has('store_logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tenant.fields.store_logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_number">{{ trans('cruds.tenant.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $tenant->phone_number) }}">
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tenant.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.tenant.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $tenant->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tenant.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $tenant->is_active || old('is_active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.tenant.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tenant.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="valid_until">{{ trans('cruds.tenant.fields.valid_until') }}</label>
                <input class="form-control datetime {{ $errors->has('valid_until') ? 'is-invalid' : '' }}" type="text" name="valid_until" id="valid_until" value="{{ old('valid_until', $tenant->valid_until) }}" required>
                @if($errors->has('valid_until'))
                    <div class="invalid-feedback">
                        {{ $errors->first('valid_until') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tenant.fields.valid_until_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="store_location">{{ trans('cruds.tenant.fields.store_location') }}</label>
                <textarea class="form-control {{ $errors->has('store_location') ? 'is-invalid' : '' }}" name="store_location" id="store_location">{{ old('store_location', $tenant->store_location) }}</textarea>
                @if($errors->has('store_location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tenant.fields.store_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="package_id">{{ trans('cruds.tenant.fields.package') }}</label>
                <select class="form-control select2 {{ $errors->has('package') ? 'is-invalid' : '' }}" name="package_id" id="package_id">
                    @foreach($packages as $id => $entry)
                        <option value="{{ $id }}" {{ (old('package_id') ? old('package_id') : $tenant->package->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('package'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tenant.fields.package_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="created_by_id">{{ trans('cruds.tenant.fields.created_by') }}</label>
                <select class="form-control select2 {{ $errors->has('created_by') ? 'is-invalid' : '' }}" name="created_by_id" id="created_by_id" required>
                    @foreach($created_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('created_by_id') ? old('created_by_id') : $tenant->created_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('created_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('created_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tenant.fields.created_by_helper') }}</span>
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
    Dropzone.options.storeLogoDropzone = {
    url: '{{ route('admin.tenants.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="store_logo"]').remove()
      $('form').append('<input type="hidden" name="store_logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="store_logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($tenant) && $tenant->store_logo)
      var file = {!! json_encode($tenant->store_logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="store_logo" value="' + file.file_name + '">')
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