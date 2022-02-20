@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.theme.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.themes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.theme.fields.id') }}
                        </th>
                        <td>
                            {{ $theme->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.theme.fields.title') }}
                        </th>
                        <td>
                            {{ $theme->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.theme.fields.description') }}
                        </th>
                        <td>
                            {{ $theme->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.theme.fields.screenshot') }}
                        </th>
                        <td>
                            @if($theme->screenshot)
                                <a href="{{ $theme->screenshot->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $theme->screenshot->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.theme.fields.tenant') }}
                        </th>
                        <td>
                            @foreach($theme->tenants as $key => $tenant)
                                <span class="label label-info">{{ $tenant->store_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.themes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection