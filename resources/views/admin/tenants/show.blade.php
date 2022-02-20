@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tenant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tenants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.id') }}
                        </th>
                        <td>
                            {{ $tenant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.store_name') }}
                        </th>
                        <td>
                            {{ $tenant->store_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.store_logo') }}
                        </th>
                        <td>
                            @if($tenant->store_logo)
                                <a href="{{ $tenant->store_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $tenant->store_logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $tenant->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.email') }}
                        </th>
                        <td>
                            {{ $tenant->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $tenant->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.valid_until') }}
                        </th>
                        <td>
                            {{ $tenant->valid_until }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.store_location') }}
                        </th>
                        <td>
                            {{ $tenant->store_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.package') }}
                        </th>
                        <td>
                            {{ $tenant->package->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.created_by') }}
                        </th>
                        <td>
                            {{ $tenant->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tenants.index') }}">
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
            <a class="nav-link" href="#tenant_domains" role="tab" data-toggle="tab">
                {{ trans('cruds.domain.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tenant_payments" role="tab" data-toggle="tab">
                {{ trans('cruds.payment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tenant_themes" role="tab" data-toggle="tab">
                {{ trans('cruds.theme.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tenant_domains">
            @includeIf('admin.tenants.relationships.tenantDomains', ['domains' => $tenant->tenantDomains])
        </div>
        <div class="tab-pane" role="tabpanel" id="tenant_payments">
            @includeIf('admin.tenants.relationships.tenantPayments', ['payments' => $tenant->tenantPayments])
        </div>
        <div class="tab-pane" role="tabpanel" id="tenant_themes">
            @includeIf('admin.tenants.relationships.tenantThemes', ['themes' => $tenant->tenantThemes])
        </div>
    </div>
</div>

@endsection