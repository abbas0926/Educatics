@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.studentPayment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.student-payments.update", [$studentPayment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="charged_by_id">{{ trans('cruds.studentPayment.fields.charged_by') }}</label>
                <select class="form-control select2 {{ $errors->has('charged_by') ? 'is-invalid' : '' }}" name="charged_by_id" id="charged_by_id">
                    @foreach($charged_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('charged_by_id') ? old('charged_by_id') : $studentPayment->charged_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('charged_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('charged_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentPayment.fields.charged_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.studentPayment.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $studentPayment->amount) }}" step="0.01" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentPayment.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.studentPayment.fields.payment_method') }}</label>
                <select class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method" id="payment_method" required>
                    <option value disabled {{ old('payment_method', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\StudentPayment::PAYMENT_METHOD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_method', $studentPayment->payment_method) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentPayment.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachement">{{ trans('cruds.studentPayment.fields.attachement') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachement') ? 'is-invalid' : '' }}" id="attachement-dropzone">
                </div>
                @if($errors->has('attachement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attachement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentPayment.fields.attachement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="invoice_id">{{ trans('cruds.studentPayment.fields.invoice') }}</label>
                <select class="form-control select2 {{ $errors->has('invoice') ? 'is-invalid' : '' }}" name="invoice_id" id="invoice_id">
                    @foreach($invoices as $id => $entry)
                        <option value="{{ $id }}" {{ (old('invoice_id') ? old('invoice_id') : $studentPayment->invoice->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('invoice'))
                    <div class="invalid-feedback">
                        {{ $errors->first('invoice') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentPayment.fields.invoice_helper') }}</span>
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
    var uploadedAttachementMap = {}
Dropzone.options.attachementDropzone = {
    url: '{{ route('tenant.student-payments.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="attachement[]" value="' + response.name + '">')
      uploadedAttachementMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachementMap[file.name]
      }
      $('form').find('input[name="attachement[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($studentPayment) && $studentPayment->attachement)
      var files = {!! json_encode($studentPayment->attachement) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="attachement[]" value="' + file.file_name + '">')
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