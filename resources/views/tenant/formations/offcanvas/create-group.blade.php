<div class="offcanvas offcanvas-end" tabindex="-1" id="createGroupCanva" aria-labelledby="createGroupCanvaLabel">
    <div class="offcanvas-header">
        <h5 id="createGroupCanvaLabel">{{ __('Create new Group') }}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="POST" action="{{ route("tenant.groups.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="promotion_id">{{ trans('cruds.group.fields.promotion') }}</label>
                <select class="form-control select2 {{ $errors->has('promotion') ? 'is-invalid' : '' }}" name="promotion_id" id="promotion_id" required>
                    @foreach($promotions as $promotion)
                        <option value="{{ $promotion->id }}" {{ old('promotion_id') == $promotion->id ? 'selected' : '' }}>{{ $promotion->name }}</option>
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
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
                </div>

            </div>
        </form>
    </div>
</div>
