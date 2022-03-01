@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.invoice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.invoices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="subject">{{ trans('cruds.invoice.fields.subject') }}</label>
                        <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', '') }}">
                        @if($errors->has('subject'))
                            <div class="invalid-feedback">
                                {{ $errors->first('subject') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.subject_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="required" for="student_id">{{ trans('cruds.invoice.fields.student') }}</label>
                        <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id" required>
                            @foreach($students as $id => $entry)
                                <option value="{{ $id }}" {{ old('student_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('student'))
                            <div class="invalid-feedback">
                                {{ $errors->first('student') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.student_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="deadline">{{ trans('cruds.invoice.fields.deadline') }}</label>
                        <input class="form-control date {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline" value="{{ old('deadline') }}">
                        @if($errors->has('deadline'))
                            <div class="invalid-feedback">
                                {{ $errors->first('deadline') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.deadline_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="row" id="app">
                <div class="col-md-12">
                    <invoice-page></invoice-page>
                </div>
             

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
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection