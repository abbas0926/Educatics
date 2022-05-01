<div class="offcanvas offcanvas-end" tabindex="-1" id="createPromotionCanva" aria-labelledby="createPromotionCanvaLabel">
    <div class="offcanvas-header">
        <h5 id="createPromotionCanvaLabel">{{ __('Create new Promotion') }}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="POST" action="{{ route('tenant.promotions.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="formation_id" value="{{ $formation->id }}" hidden>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.promotion.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', '') }}" required>
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.promotion.fields.name_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required"
                    for="starting_date">{{ trans('cruds.promotion.fields.starting_date') }}</label>
                <input class="form-control date {{ $errors->has('starting_date') ? 'is-invalid' : '' }}" type="text"
                    name="starting_date" id="starting_date" value="{{ old('starting_date') }}" required>
                @if ($errors->has('starting_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('starting_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.promotion.fields.starting_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required"
                    for="ending_date">{{ trans('cruds.promotion.fields.ending_date') }}</label>
                <input class="form-control date {{ $errors->has('ending_date') ? 'is-invalid' : '' }}" type="text"
                    name="ending_date" id="ending_date" value="{{ old('ending_date') }}" required>
                @if ($errors->has('ending_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ending_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.promotion.fields.ending_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.promotion.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"
                    name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if ($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.promotion.fields.price_helper') }}</span>
            </div>

            <div class="form-group">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
                </div>

            </div>
        </form>
    </div>
</div>
