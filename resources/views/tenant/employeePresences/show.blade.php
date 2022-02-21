@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.employeePresence.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.employee-presences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.employeePresence.fields.id') }}
                        </th>
                        <td>
                            {{ $employeePresence->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeePresence.fields.employee') }}
                        </th>
                        <td>
                            {{ $employeePresence->employee->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeePresence.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\EmployeePresence::STATUS_SELECT[$employeePresence->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeePresence.fields.note') }}
                        </th>
                        <td>
                            {{ $employeePresence->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeePresence.fields.started_at') }}
                        </th>
                        <td>
                            {{ $employeePresence->started_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeePresence.fields.ended_at') }}
                        </th>
                        <td>
                            {{ $employeePresence->ended_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.employee-presences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection