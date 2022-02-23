@extends('layouts.tenant')
@section('content')
    <div class="row">
        <div class="col-md-8 mb-3">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.lead.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('tenant.leads.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $lead->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.first_name') }}
                                    </th>
                                    <td>
                                        {{ $lead->first_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.last_name') }}
                                    </th>
                                    <td>
                                        {{ $lead->last_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $lead->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $lead->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Lead::STATUS_SELECT[$lead->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.source') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Lead::SOURCE_SELECT[$lead->source] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $lead->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.formation') }}
                                    </th>
                                    <td>
                                        @foreach ($lead->formations as $key => $formation)
                                            <span class="label label-info">{{ $formation->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.events') }}
                                    </th>
                                    <td>
                                        @foreach ($lead->events as $key => $events)
                                            <span class="label label-info">{{ $events->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lead.fields.marketing_campaign') }}
                                    </th>
                                    <td>
                                        {{ $lead->marketing_campaign->title ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('tenant.leads.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('lead_interaction_show')
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        {{ trans('cruds.leadInteraction.title') }}
                    </div>
                    @can('lead_interaction_create')
                    <div class="card-toolbar">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                            aria-expanded="false" aria-controls="collapseExample">
                            {{ __('global.add') }}
                        </button>
                    </div>
                    @endcan
                </div>
                <div class="card-body p-1">
                    @can('lead_interaction_create')
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="{{ route("tenant.leads.addInteraction",['lead'=>$lead]) }}" method="post">
                                @method("POST")
                                @csrf
                                <input type="hidden" name="lead_id" value="{{$lead->id}}">
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                <div class="form-group">
                                    <label for="notes">{{ trans('cruds.leadInteraction.fields.notes') }}</label>
                                    <textarea class="form-control ckeditor {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{!! old('notes') !!}</textarea>
                                    @if($errors->has('notes'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('notes') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.leadInteraction.fields.notes_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('cruds.leadInteraction.fields.communication_channel') }}</label>
                                    <select class="form-control {{ $errors->has('communication_channel') ? 'is-invalid' : '' }}" name="communication_channel" id="communication_channel">
                                        <option value disabled {{ old('communication_channel', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\LeadInteraction::COMMUNICATION_CHANNEL_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('communication_channel', 'Email') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('communication_channel'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('communication_channel') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.leadInteraction.fields.communication_channel_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger" type="submit">
                                        {{ trans('global.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endcan
                    <ul class="list-group">
                        
                        @foreach ($lead->recentInteractions as $interaction)
                            <li class="list-group-item ">
                                <div class="card-title">{{ trans('cruds.leadInteraction.title') }}
                                    {{ $loop->index + 1 }}</div>
                                <div class="mb-1">
                                    @if (is_null($interaction->notes))
                                        {{ __('crud.leadsInteraction.no_notes') }}
                                    @else
                                        {{ $interaction->notes }}
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge badge-secondary badge-pill">
                                        <i class="fa fa-user"> {{ $interaction->user->name }} </i>
                                    </span>
                                    <span class="badge badge-secondary badge-pill">
                                        <i class="fa fa-comments">   {{ $interaction->communication_channel }}</i>
                                        
                                    </span>

                                    <span class="badge badge-secondary ">
                                        <i class="fa fa-clock-o">  {{ $interaction->created_at->diffForHumans()}} </i>
                                    </span>
                                    <a href="{{route('tenant.leads.dettachInterraction',['interaction'=>$interaction])}}" data-toggle="modal" data-target="#deleteModal" class="badge badge-danger delete_link">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>

            </div>

        </div>
        @endcan
    </div>
@endsection


@include('partials.tenant.delete_modals')
