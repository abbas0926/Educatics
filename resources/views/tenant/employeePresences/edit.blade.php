@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employeePresence.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.employee-presences.update", [$employeePresence->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.employeePresence.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $employeePresence->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employee') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employeePresence.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.employeePresence.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\EmployeePresence::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $employeePresence->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employeePresence.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.employeePresence.fields.note') }}</label>
                <input class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" type="text" name="note" id="note" value="{{ old('note', $employeePresence->note) }}">
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employeePresence.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="started_at">{{ trans('cruds.employeePresence.fields.started_at') }}</label>
                <input class="form-control datetime {{ $errors->has('started_at') ? 'is-invalid' : '' }}" type="text" name="started_at" id="started_at" value="{{ old('started_at', $employeePresence->started_at) }}" required>
                @if($errors->has('started_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('started_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employeePresence.fields.started_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ended_at">{{ trans('cruds.employeePresence.fields.ended_at') }}</label>
                <input class="form-control datetime {{ $errors->has('ended_at') ? 'is-invalid' : '' }}" type="text" name="ended_at" id="ended_at" value="{{ old('ended_at', $employeePresence->ended_at) }}">
                @if($errors->has('ended_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ended_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employeePresence.fields.ended_at_helper') }}</span>
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