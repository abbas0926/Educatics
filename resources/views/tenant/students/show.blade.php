@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.student.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.students.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.id') }}
                        </th>
                        <td>
                            {{ $student->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.attachements') }}
                        </th>
                        <td>
                            @foreach($student->attachements as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.first_name') }}
                        </th>
                        <td>
                            {{ $student->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.last_name') }}
                        </th>
                        <td>
                            {{ $student->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.email') }}
                        </th>
                        <td>
                            {{ $student->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.birthdate') }}
                        </th>
                        <td>
                            {{ $student->birthdate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.adresse') }}
                        </th>
                        <td>
                            {{ $student->adresse }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.study_level') }}
                        </th>
                        <td>
                            {{ $student->study_level }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.establishement') }}
                        </th>
                        <td>
                            {{ $student->establishement }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.photo') }}
                        </th>
                        <td>
                            @if($student->photo)
                                <a href="{{ $student->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $student->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.matricule') }}
                        </th>
                        <td>
                            {{ $student->matricule }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.students.index') }}">
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
            <a class="nav-link" href="#student_invoices" role="tab" data-toggle="tab">
                {{ trans('cruds.invoice.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#student_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.group.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#student_promotions" role="tab" data-toggle="tab">
                {{ trans('cruds.promotion.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#presence_student_lessons" role="tab" data-toggle="tab">
                {{ trans('cruds.lesson.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="student_invoices">
            @includeIf('admin.students.relationships.studentInvoices', ['invoices' => $student->studentInvoices])
        </div>
        <div class="tab-pane" role="tabpanel" id="student_groups">
            @includeIf('admin.students.relationships.studentGroups', ['groups' => $student->studentGroups])
        </div>
        <div class="tab-pane" role="tabpanel" id="student_promotions">
            @includeIf('admin.students.relationships.studentPromotions', ['promotions' => $student->studentPromotions])
        </div>
        <div class="tab-pane" role="tabpanel" id="presence_student_lessons">
            @includeIf('admin.students.relationships.presenceStudentLessons', ['lessons' => $student->presenceStudentLessons])
        </div>
    </div>
</div>

@endsection