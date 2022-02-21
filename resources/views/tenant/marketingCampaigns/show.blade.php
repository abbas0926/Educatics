@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.marketingCampaign.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.marketing-campaigns.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.id') }}
                        </th>
                        <td>
                            {{ $marketingCampaign->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.title') }}
                        </th>
                        <td>
                            {{ $marketingCampaign->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.gallery') }}
                        </th>
                        <td>
                            @foreach($marketingCampaign->gallery as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.manager') }}
                        </th>
                        <td>
                            {{ $marketingCampaign->manager->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.budget') }}
                        </th>
                        <td>
                            {{ $marketingCampaign->budget }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.formation') }}
                        </th>
                        <td>
                            @foreach($marketingCampaign->formations as $key => $formation)
                                <span class="label label-info">{{ $formation->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.events') }}
                        </th>
                        <td>
                            @foreach($marketingCampaign->events as $key => $events)
                                <span class="label label-info">{{ $events->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.lead') }}
                        </th>
                        <td>
                            @foreach($marketingCampaign->leads as $key => $lead)
                                <span class="label label-info">{{ $lead->last_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.expenses') }}
                        </th>
                        <td>
                            @foreach($marketingCampaign->expenses as $key => $expenses)
                                <span class="label label-info">{{ $expenses->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.marketing-campaigns.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection