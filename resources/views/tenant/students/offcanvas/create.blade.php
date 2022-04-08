
<div class="offcanvas offcanvas-end" tabindex="-1" id="createStudentCanva" aria-labelledby="createStudentCanvaLabel">
  <div class="offcanvas-header">
    <h5 id="createStudentCanvaLabel">{{__('cruds.create_student')}}</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form method="POST" action="{{ route("tenant.students.store") }}" enctype="multipart/form-data">
        @csrf
        
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
            <label for="phone">{{ trans('cruds.phone') }}</label>
            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
            @if($errors->has('phone'))
                <div class="invalid-feedback">
                    {{ $errors->first('phone') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.student.fields.email_helper') }}</span>
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
          <label for="" class="form-label">{{__('cruds.gender')}} </label>
          <select class="form-control" name="gender" id="">
            <option value="female">{{__('cruds.female')}}</option>
            <option value="male">{{__('cruds.male')}}</option>

          </select>
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
            <textarea class="form-control {{ $errors->has('adresse') ? 'is-invalid' : '' }}" type="text" name="adresse" id="adresse" value="{{ old('adresse', '') }}"></textarea>
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
            <div class="d-grid gap-2">
              <button type="submit"  class="btn btn-primary">{{ trans('global.save') }}</button>
            </div>

        </div>
    </form>
  </div>
</div>