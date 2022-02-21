@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.invoiceItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.invoice-items.update", [$invoiceItem->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="formation_id">{{ trans('cruds.invoiceItem.fields.formation') }}</label>
                <select class="form-control select2 {{ $errors->has('formation') ? 'is-invalid' : '' }}" name="formation_id" id="formation_id">
                    @foreach($formations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('formation_id') ? old('formation_id') : $invoiceItem->formation->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('formation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceItem.fields.formation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="event_id">{{ trans('cruds.invoiceItem.fields.event') }}</label>
                <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id">
                    @foreach($events as $id => $entry)
                        <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $invoiceItem->event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceItem.fields.event_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.invoiceItem.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $invoiceItem->quantity) }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceItem.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.invoiceItem.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $invoiceItem->price) }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceItem.fields.price_helper') }}</span>
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