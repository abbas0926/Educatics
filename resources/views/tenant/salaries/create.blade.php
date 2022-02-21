@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.salary.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.salaries.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.salary.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employee') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.salary.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.salary.fields.month') }}</label>
                <select class="form-control {{ $errors->has('month') ? 'is-invalid' : '' }}" name="month" id="month">
                    <option value disabled {{ old('month', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Salary::MONTH_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('month', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.salary.fields.month_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="taken_salary">{{ trans('cruds.salary.fields.taken_salary') }}</label>
                <input class="form-control {{ $errors->has('taken_salary') ? 'is-invalid' : '' }}" type="number" name="taken_salary" id="taken_salary" value="{{ old('taken_salary', '') }}" step="0.01" required>
                @if($errors->has('taken_salary'))
                    <div class="invalid-feedback">
                        {{ $errors->first('taken_salary') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.salary.fields.taken_salary_helper') }}</span>
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