@extends('layouts.tenant')
@section('content')
    <div class="row">
        <div class="col-md-5 ">
            <div class="card">
                <div class="card-header text-center">
                    <img src="{{$teacher->photo_url}}" class="img-fluid rounded-circle w-50" alt="{{ $teacher->first_name }}" />
                    <h5 class="card-title mt-3">{{ $teacher->lastname }} </h5>
                    <strong class="muted"> {{ $teacher->phone }}</strong>
                </div>
                <div class="card-body">
                        <table class="table table-sm table-borderless ">
                        <tbody>
                            <tr>
                                <td> {{ __('cruds.email') }} </td>  <td><strong>{{ $teacher->email }}</strong></td>
                            </tr>
                            <tr>
                                <td> {{ __('cruds.adresse') }} </td>  <td><strong>{{ $teacher->adresse }}</strong></td>
                            </tr>
                            <tr>
                                <td> {{ __('cruds.birthdate') }} </td>  <td><strong>{{ $teacher->birthdate }}</strong></td>
                            </tr>
                            <tr>
                                <td> {{ __('cruds.gender') }} </td>  <td><strong>{{ $teacher->gender }}</strong></td>
                            </tr>
                            <tr>
                                <td> {{ trans('cruds.employee.fields.id') }} </td>  <td><strong>{{ $teacher->id }}</strong></td>
                            </tr>
                            <tr>
                                <td>   {{ trans('cruds.employee.fields.title') }} </td>  <td><strong> {{ $teacher->title }}</strong></td>
                            </tr>
                            <tr>
                                <td>   {{ trans('cruds.employee.fields.status') }} </td>  <td><strong> {{ App\Models\Employee::STATUS_SELECT[$teacher->status] ?? '' }}</strong></td>
                            </tr>
                            <tr>
                                <td>   {{ trans('cruds.employee.fields.attachements') }} </td>  <td><strong>
                                     {{-- @foreach($teacher->attachements as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach--}}
                            </strong></td> 
                            </tr>
                            <tr>
                                <td>   {{ trans('cruds.employee.fields.salary') }} </td>  <td><strong>  {{ $teacher->salary }}</strong></td>
                            </tr>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card mb-2">
                <div class="card-header">
                    {{ trans('cruds.salary.title') }}
                </div>
                <div class="card-body">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-employeeSalaries">
                        <thead>
                            <tr>
                                <th width="10">
        
                                </th>
                                <th>
                                    {{ trans('cruds.salary.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.salary.fields.month') }}
                                </th>
                                <th>
                                    {{ trans('cruds.salary.fields.taken_salary') }}
                                </th>
                                <th>
                                   Actions
                                </th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach($teacher->employeeSalaries as $key => $salary)
                                <tr data-entry-id="{{ $salary->id }}">
                                    <td>
        
                                    </td>
                                    <td>
                                        {{ $salary->id ?? '' }}
                                    </td>
                                  
                                    <td>
                                        {{ App\Models\Salary::MONTH_SELECT[$salary->month] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $salary->taken_salary ?? '' }}
                                    </td>
                                    <td>
                                        @can('salary_show')
                                            <a class="btn btn-xs btn-primary" href="{{ route('tenant.salaries.show', $salary->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                        @endcan
        
                                        @can('salary_edit')
                                            <a class="btn btn-xs btn-info" href="{{ route('tenant.salaries.edit', $salary->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan
        
                                        @can('salary_delete')
                                            <form action="{{ route('tenant.salaries.destroy', $salary->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                            </form>
                                        @endcan
        
                                    </td>
        
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div>
            
        </div>

    </div>


@endsection
