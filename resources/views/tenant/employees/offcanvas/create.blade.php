
<div class="offcanvas offcanvas-end" tabindex="-1" id="createEmployeeCanva" aria-labelledby="createEmployeeCanvaLabel">
  <div class="offcanvas-header">
    <h5 id="createStudentCanvaLabel">{{__('Create new Employee')}}</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form method="POST" action="{{ route("tenant.employees.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">{{ trans('cruds.employee.fields.title') }}</label>
            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
            @if($errors->has('title'))
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.employee.fields.title_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="first_name">{{ trans('cruds.employee.fields.first_name') }}</label>
            <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}">
            @if($errors->has('first_name'))
                <div class="invalid-feedback">
                    {{ $errors->first('first_name') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.employee.fields.first_name_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="last_name">{{ trans('cruds.employee.fields.last_name') }}</label>
            <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}">
            @if($errors->has('last_name'))
                <div class="invalid-feedback">
                    {{ $errors->first('last_name') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.employee.fields.last_name_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="phone">{{ trans('cruds.employee.fields.phone') }}</label>
            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
            @if($errors->has('phone'))
                <div class="invalid-feedback">
                    {{ $errors->first('phone') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.employee.fields.phone_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="email">{{ trans('cruds.employee.fields.email') }}</label>
            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.employee.fields.email_helper') }}</span>
        </div>
        <div class="form-group">
            <label>{{ trans('cruds.employee.fields.status') }}</label>
            <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                @foreach(App\Models\Employee::STATUS_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @if($errors->has('status'))
                <div class="invalid-feedback">
                    {{ $errors->first('status') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.employee.fields.status_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="photo">{{ trans('cruds.employee.fields.photo') }}</label>
            <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
            </div>
            @if($errors->has('photo'))
                <div class="invalid-feedback">
                    {{ $errors->first('photo') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.employee.fields.photo_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="attachements">{{ trans('cruds.employee.fields.attachements') }}</label>
            <div class="needsclick dropzone {{ $errors->has('attachements') ? 'is-invalid' : '' }}" id="attachements-dropzone">
            </div>
            @if($errors->has('attachements'))
                <div class="invalid-feedback">
                    {{ $errors->first('attachements') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.employee.fields.attachements_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="salary">{{ trans('cruds.employee.fields.salary') }}</label>
            <input class="form-control {{ $errors->has('salary') ? 'is-invalid' : '' }}" type="number" name="salary" id="salary" value="{{ old('salary', '') }}" step="0.01">
            @if($errors->has('salary'))
                <div class="invalid-feedback">
                    {{ $errors->first('salary') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.employee.fields.salary_helper') }}</span>
        </div>
        <div class="form-group">
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
   
    </form>
  </div>
</div>