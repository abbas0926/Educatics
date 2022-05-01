<div class="offcanvas offcanvas-end" tabindex="-1" id="createFormationCanva" aria-labelledby="createFormationCanvaLabel">
    <div class="offcanvas-header">
        <h5 id="createFormationCanvaLabel">{{ __('Create new formation') }}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="POST" action="{{ route('tenant.formations.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.formation.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                    id="title" value="{{ old('title', '') }}" required>
                @if ($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.formation.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.formation.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                    id="description">{!! old('description') !!}</textarea>
                @if ($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.formation.fields.description_helper') }}</span>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="duration">{{ trans('cruds.formation.fields.duration') }}</label>
                        <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number"
                            name="duration" id="duration" value="{{ old('duration', '') }}">
                        @if ($errors->has('duration'))
                            <div class="invalid-feedback">
                                {{ $errors->first('duration') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.formation.fields.duration_helper') }}</span>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="" class="form-label">{{ __('Choose duration unit') }}</label>
                            <select class="form-control" name="duration_type" id="">
                                @foreach (App\Models\Formation::DURATION_SELECT as $key => $value)
                                    <option value="{{ $key }}"
                                        @if (old('duration_type') === $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="price">{{ trans('cruds.formation.fields.price') }}</label>
                        <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"
                            name="price" id="price" value="{{ old('price', '') }}" required>
                        @if ($errors->has('price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.formation.fields.price_helper') }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="" class="form-label">{{ __('Payment frequency') }}</label>
                            <select class="form-control" name="payment_frequency" id="">
                                @foreach (App\Models\Formation::PAYMENT_TYPE as $key => $value)
                                    <option value="{{ $key }}"
                                        @if (old('payment_frequency') === $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

            </div>

            <div class="form-group">
                <label for="featured_image">{{ trans('cruds.formation.fields.featured_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}"
                    id="featured_image-dropzone">
                </div>
                @if ($errors->has('featured_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('featured_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.formation.fields.featured_image_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="syllabus">{{ trans('cruds.formation.fields.syllabus') }}</label>
                <div class="needsclick dropzone {{ $errors->has('syllabus') ? 'is-invalid' : '' }}"
                    id="syllabus-dropzone">
                </div>
                @if ($errors->has('syllabus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('syllabus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.formation.fields.syllabus_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.formation.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                    id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach (App\Models\Formation::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}"
                            {{ old('status', 'draft') === (string) $key ? 'selected' : '' }}>{{ $label }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.formation.fields.status_helper') }}</span>
            </div>

            <div class="form-group">
                <div class="d-grid gap-2">
                  <button type="submit"  class="btn btn-success">{{__('Create')}}</button>
                </div>

            </div>
        </form>
    </div>
</div>
