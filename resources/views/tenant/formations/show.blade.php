@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.formation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.formations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.formation.fields.id') }}
                        </th>
                        <td>
                            {{ $formation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.formation.fields.title') }}
                        </th>
                        <td>
                            {{ $formation->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.formation.fields.description') }}
                        </th>
                        <td>
                            {!! $formation->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.formation.fields.price') }}
                        </th>
                        <td>
                            {{ $formation->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.formation.fields.featured_image') }}
                        </th>
                        <td>
                            @if($formation->featured_image)
                                <a href="{{ $formation->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $formation->featured_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.formation.fields.duration') }}
                        </th>
                        <td>
                            {{ $formation->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.formation.fields.syllabus') }}
                        </th>
                        <td>
                            @foreach($formation->syllabus as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.formation.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Formation::STATUS_SELECT[$formation->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.formation.fields.slug') }}
                        </th>
                        <td>
                            {{ $formation->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.formations.index') }}">
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
            <a class="nav-link" href="#formation_promotions" role="tab" data-toggle="tab">
                {{ trans('cruds.promotion.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="formation_promotions">
            @includeIf('admin.formations.relationships.formationPromotions', ['promotions' => $formation->formationPromotions])
        </div>
    </div>
</div>

@endsection