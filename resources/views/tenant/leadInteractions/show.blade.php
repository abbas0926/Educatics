@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.leadInteraction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.lead-interactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.leadInteraction.fields.id') }}
                        </th>
                        <td>
                            {{ $leadInteraction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.leadInteraction.fields.lead') }}
                        </th>
                        <td>
                            {{ $leadInteraction->lead->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.leadInteraction.fields.communication_channel') }}
                        </th>
                        <td>
                            {{ App\Models\LeadInteraction::COMMUNICATION_CHANNEL_SELECT[$leadInteraction->communication_channel] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.leadInteraction.fields.notes') }}
                        </th>
                        <td>
                            {!! $leadInteraction->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.leadInteraction.fields.user') }}
                        </th>
                        <td>
                            {{ $leadInteraction->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.lead-interactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection