@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lead.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.leads.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="first_name">{{ trans('cruds.lead.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}">
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_name">{{ trans('cruds.lead.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}">
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.lead.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.lead.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.lead.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Lead::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'cold') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.lead.fields.source') }}</label>
                <select class="form-control {{ $errors->has('source') ? 'is-invalid' : '' }}" name="source" id="source">
                    <option value disabled {{ old('source', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Lead::SOURCE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('source', 'website') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('source'))
                    <div class="invalid-feedback">
                        {{ $errors->first('source') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.source_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.lead.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="formations">{{ trans('cruds.lead.fields.formation') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('formations') ? 'is-invalid' : '' }}" name="formations[]" id="formations" multiple>
                    @foreach($formations as $id => $formation)
                        <option value="{{ $id }}" {{ in_array($id, old('formations', [])) ? 'selected' : '' }}>{{ $formation }}</option>
                    @endforeach
                </select>
                @if($errors->has('formations'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formations') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.formation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="events">{{ trans('cruds.lead.fields.events') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('events') ? 'is-invalid' : '' }}" name="events[]" id="events" multiple>
                    @foreach($events as $id => $event)
                        <option value="{{ $id }}" {{ in_array($id, old('events', [])) ? 'selected' : '' }}>{{ $event }}</option>
                    @endforeach
                </select>
                @if($errors->has('events'))
                    <div class="invalid-feedback">
                        {{ $errors->first('events') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.events_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="marketing_campaign_id">{{ trans('cruds.lead.fields.marketing_campaign') }}</label>
                <select class="form-control select2 {{ $errors->has('marketing_campaign') ? 'is-invalid' : '' }}" name="marketing_campaign_id" id="marketing_campaign_id">
                    @foreach($marketing_campaigns as $id => $entry)
                        <option value="{{ $id }}" {{ old('marketing_campaign_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('marketing_campaign'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marketing_campaign') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lead.fields.marketing_campaign_helper') }}</span>
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