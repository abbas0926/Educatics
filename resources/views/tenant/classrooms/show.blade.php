@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.classroom.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.classrooms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.id') }}
                        </th>
                        <td>
                            {{ $classroom->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.name') }}
                        </th>
                        <td>
                            {{ $classroom->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.capacity') }}
                        </th>
                        <td>
                            {{ $classroom->capacity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.equipments') }}
                        </th>
                        <td>
                            {!! $classroom->equipments !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.classrooms.index') }}">
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
            <a class="nav-link" href="#classroom_lessons" role="tab" data-toggle="tab">
                {{ trans('cruds.lesson.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="classroom_lessons">
            @includeIf('admin.classrooms.relationships.classroomLessons', ['lessons' => $classroom->classroomLessons])
        </div>
    </div>
</div>

@endsection