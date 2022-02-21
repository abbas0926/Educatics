@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.marketingCampaign.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.marketing-campaigns.update", [$marketingCampaign->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.marketingCampaign.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $marketingCampaign->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingCampaign.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gallery">{{ trans('cruds.marketingCampaign.fields.gallery') }}</label>
                <div class="needsclick dropzone {{ $errors->has('gallery') ? 'is-invalid' : '' }}" id="gallery-dropzone">
                </div>
                @if($errors->has('gallery'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gallery') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingCampaign.fields.gallery_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="manager_id">{{ trans('cruds.marketingCampaign.fields.manager') }}</label>
                <select class="form-control select2 {{ $errors->has('manager') ? 'is-invalid' : '' }}" name="manager_id" id="manager_id">
                    @foreach($managers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('manager_id') ? old('manager_id') : $marketingCampaign->manager->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('manager'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manager') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingCampaign.fields.manager_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="budget">{{ trans('cruds.marketingCampaign.fields.budget') }}</label>
                <input class="form-control {{ $errors->has('budget') ? 'is-invalid' : '' }}" type="number" name="budget" id="budget" value="{{ old('budget', $marketingCampaign->budget) }}" step="0.01">
                @if($errors->has('budget'))
                    <div class="invalid-feedback">
                        {{ $errors->first('budget') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingCampaign.fields.budget_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="formations">{{ trans('cruds.marketingCampaign.fields.formation') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('formations') ? 'is-invalid' : '' }}" name="formations[]" id="formations" multiple>
                    @foreach($formations as $id => $formation)
                        <option value="{{ $id }}" {{ (in_array($id, old('formations', [])) || $marketingCampaign->formations->contains($id)) ? 'selected' : '' }}>{{ $formation }}</option>
                    @endforeach
                </select>
                @if($errors->has('formations'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formations') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingCampaign.fields.formation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="events">{{ trans('cruds.marketingCampaign.fields.events') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('events') ? 'is-invalid' : '' }}" name="events[]" id="events" multiple>
                    @foreach($events as $id => $event)
                        <option value="{{ $id }}" {{ (in_array($id, old('events', [])) || $marketingCampaign->events->contains($id)) ? 'selected' : '' }}>{{ $event }}</option>
                    @endforeach
                </select>
                @if($errors->has('events'))
                    <div class="invalid-feedback">
                        {{ $errors->first('events') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingCampaign.fields.events_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="leads">{{ trans('cruds.marketingCampaign.fields.lead') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('leads') ? 'is-invalid' : '' }}" name="leads[]" id="leads" multiple>
                    @foreach($leads as $id => $lead)
                        <option value="{{ $id }}" {{ (in_array($id, old('leads', [])) || $marketingCampaign->leads->contains($id)) ? 'selected' : '' }}>{{ $lead }}</option>
                    @endforeach
                </select>
                @if($errors->has('leads'))
                    <div class="invalid-feedback">
                        {{ $errors->first('leads') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingCampaign.fields.lead_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="expenses">{{ trans('cruds.marketingCampaign.fields.expenses') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('expenses') ? 'is-invalid' : '' }}" name="expenses[]" id="expenses" multiple>
                    @foreach($expenses as $id => $expense)
                        <option value="{{ $id }}" {{ (in_array($id, old('expenses', [])) || $marketingCampaign->expenses->contains($id)) ? 'selected' : '' }}>{{ $expense }}</option>
                    @endforeach
                </select>
                @if($errors->has('expenses'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expenses') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingCampaign.fields.expenses_helper') }}</span>
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
<script>
    var uploadedGalleryMap = {}
Dropzone.options.galleryDropzone = {
    url: '{{ route('tenant.marketing-campaigns.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="gallery[]" value="' + response.name + '">')
      uploadedGalleryMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedGalleryMap[file.name]
      }
      $('form').find('input[name="gallery[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($marketingCampaign) && $marketingCampaign->gallery)
      var files = {!! json_encode($marketingCampaign->gallery) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="gallery[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection