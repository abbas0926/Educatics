@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.invoice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.invoices.update", [$invoice->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="subject">{{ trans('cruds.invoice.fields.subject') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', $invoice->subject) }}">
                @if($errors->has('subject'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subject') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="student_id">{{ trans('cruds.invoice.fields.student') }}</label>
                <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id" required>
                    @foreach($students as $id => $entry)
                        <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $invoice->student->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.student_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deadline">{{ trans('cruds.invoice.fields.deadline') }}</label>
                <input class="form-control date {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline" value="{{ old('deadline', $invoice->deadline) }}">
                @if($errors->has('deadline'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deadline') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.deadline_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tva">{{ trans('cruds.invoice.fields.tva') }}</label>
                <input class="form-control {{ $errors->has('tva') ? 'is-invalid' : '' }}" type="number" name="tva" id="tva" value="{{ old('tva', $invoice->tva) }}" step="0.01" max="100">
                @if($errors->has('tva'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tva') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.tva_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total">{{ trans('cruds.invoice.fields.total') }}</label>
                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="number" name="total" id="total" value="{{ old('total', $invoice->total) }}" step="0.01">
                @if($errors->has('total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.total_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_to_pay">{{ trans('cruds.invoice.fields.total_to_pay') }}</label>
                <input class="form-control {{ $errors->has('total_to_pay') ? 'is-invalid' : '' }}" type="number" name="total_to_pay" id="total_to_pay" value="{{ old('total_to_pay', $invoice->total_to_pay) }}" step="0.01">
                @if($errors->has('total_to_pay'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_to_pay') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.total_to_pay_helper') }}</span>
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