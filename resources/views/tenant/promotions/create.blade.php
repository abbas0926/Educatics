@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.promotion.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.promotions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.promotion.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.promotion.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="formation_id">{{ trans('cruds.promotion.fields.formation') }}</label>
                <select class="form-control select2 {{ $errors->has('formation') ? 'is-invalid' : '' }}" name="formation_id" id="formation_id" required>
                    @foreach($formations as $id => $entry)
                        <option value="{{ $id }}" {{ old('formation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('formation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.promotion.fields.formation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="starting_date">{{ trans('cruds.promotion.fields.starting_date') }}</label>
                <input class="form-control date {{ $errors->has('starting_date') ? 'is-invalid' : '' }}" type="text" name="starting_date" id="starting_date" value="{{ old('starting_date') }}" required>
                @if($errors->has('starting_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('starting_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.promotion.fields.starting_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ending_date">{{ trans('cruds.promotion.fields.ending_date') }}</label>
                <input class="form-control date {{ $errors->has('ending_date') ? 'is-invalid' : '' }}" type="text" name="ending_date" id="ending_date" value="{{ old('ending_date') }}" required>
                @if($errors->has('ending_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ending_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.promotion.fields.ending_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.promotion.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.promotion.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="students">{{ trans('cruds.promotion.fields.student') }}</label>
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
                <span class="help-block">{{ trans('cruds.promotion.fields.student_helper') }}</span>
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