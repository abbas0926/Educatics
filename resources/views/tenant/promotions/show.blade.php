@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.promotion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.promotions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.promotion.fields.id') }}
                        </th>
                        <td>
                            {{ $promotion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promotion.fields.name') }}
                        </th>
                        <td>
                            {{ $promotion->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promotion.fields.formation') }}
                        </th>
                        <td>
                            {{ $promotion->formation->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promotion.fields.starting_date') }}
                        </th>
                        <td>
                            {{ $promotion->starting_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promotion.fields.ending_date') }}
                        </th>
                        <td>
                            {{ $promotion->ending_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promotion.fields.price') }}
                        </th>
                        <td>
                            {{ $promotion->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.promotion.fields.student') }}
                        </th>
                        <td>
                            @foreach($promotion->students as $key => $student)
                                <span class="label label-info">{{ $student->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.promotions.index') }}">
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
            <a class="nav-link" href="#promotion_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.group.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="promotion_groups">
            @includeIf('admin.promotions.relationships.promotionGroups', ['groups' => $promotion->promotionGroups])
        </div>
    </div>
</div>

@endsection