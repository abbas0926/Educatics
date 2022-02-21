@extends('layouts.tenant')
@section('content')

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
                            @foreach($lead->formations as $key => $formation)
                                <span class="label label-info">{{ $formation->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lead.fields.events') }}
                        </th>
                        <td>
                            @foreach($lead->events as $key => $events)
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

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#lead_lead_interactions" role="tab" data-toggle="tab">
                {{ trans('cruds.leadInteraction.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#lead_marketing_campaigns" role="tab" data-toggle="tab">
                {{ trans('cruds.marketingCampaign.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="lead_lead_interactions">
            @includeIf('admin.leads.relationships.leadLeadInteractions', ['leadInteractions' => $lead->leadLeadInteractions])
        </div>
        <div class="tab-pane" role="tabpanel" id="lead_marketing_campaigns">
            @includeIf('admin.leads.relationships.leadMarketingCampaigns', ['marketingCampaigns' => $lead->leadMarketingCampaigns])
        </div>
    </div>
</div>

@endsection