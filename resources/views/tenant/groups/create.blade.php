@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.group.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.groups.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.group.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="promotion_id">{{ trans('cruds.group.fields.promotion') }}</label>
                <select class="form-control select2 {{ $errors->has('promotion') ? 'is-invalid' : '' }}" name="promotion_id" id="promotion_id" required>
                    @foreach($promotions as $id => $entry)
                        <option value="{{ $id }}" {{ old('promotion_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('promotion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('promotion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.promotion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="students">{{ trans('cruds.group.fields.student') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('students') ? 'is-invalid' : '' }}" name="students[]" id="students" multiple>
                    @foreach($students as $id => $student)
                        <option value="{{ $id }}" {{ in_array($id, old('students', [])) ? 'selected' : '' }}>{{ $student }}</option>
                    @endforeach
                </select>
                @if($errors->has('students'))
                    <div class="invalid-feedback">
                        {{ $errors->first('students') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.student_helper') }}</span>
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