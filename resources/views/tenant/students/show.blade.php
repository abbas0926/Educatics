@extends('layouts.tenant')
@section('content')
    <div class="row">
        <div class="col-md-5 ">
            <div class="card">
                <div class="card-header text-center">
                    <img src="{{$student->photo_url}}" class="img-fluid rounded-circle w-50" alt="{{ $student->fullName }}" />
                    <h5 class="card-title mt-3">{{ $student->fullName }} </h5>
                    <strong class="muted"> {{ $student->phone }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless ">
                        <tbody>
                            <tr>
                                <td> {{ __('cruds.email') }} </td>  <td><strong>{{ $student->email }}</strong></td>
                            </tr>
                            <tr>
                                <td> {{ __('cruds.adresse') }} </td>  <td><strong>{{ $student->adresse }}</strong></td>
                            </tr>
                            <tr>
                                <td> {{ __('cruds.birthdate') }} </td>  <td><strong>{{ $student->birthdate }}</strong></td>
                            </tr>
                            <tr>
                                <td> {{ __('cruds.gender') }} </td>  <td><strong>{{ $student->gender }}</strong></td>
                            </tr>
                            <tr>
                                <td>   {{ trans('cruds.formation.title') }} </td>  <td>@if( $student->studentPromotions->first()->formation!=null)<strong>{{ $student->studentPromotions->first()->formation->title}}  </strong>
                                    <a class="success" data-toggle="modal" data-target="#EditFormationModal"><i class="fas fa-edit"></i></a>@else
                                    <a class="success"data-toggle="modal" data-target="#AddFormationModal"><i class="fas fa-plus"></i></a>@endif
                                </td>
                            </tr>
                            <tr>
                                <td>  {{ trans('cruds.promotion.title') }} </td>  <td>@if($student->studentPromotions->first()!=null)<strong>{{ $student->studentPromotions->first()->name}}  </strong>
                                    <a class="success" data-toggle="modal" data-target="#EditPromotionModal"><i class="fas fa-edit"></i></a>@else
                                    <a class="success"data-toggle="modal" data-target="#AddPromotionModal"><i class="fas fa-plus"></i></a>@endif
                                </td>
                            </tr>
                            <tr>
                                <td>  {{ trans('cruds.group.title') }} </td>  <td>@if($student->studentGroups->first()!=null)<strong>{{ $student->studentGroups->first()->name}}  </strong>
                                    <a class="success" data-toggle="modal" data-target="#EditGroupModal"><i class="fas fa-edit"></i></a>@else
                                    <a class="success"data-toggle="modal" data-target="#AddGroupModal"><i class="fas fa-plus"></i></a>@endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card mb-2">
                <div class="card-header">
                    {{ trans('cruds.invoice.title') }}
                </div>
                <div class="card-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Invoice">
                        <thead>
                            <tr>
                               
                                <th>
                                    {{ trans('cruds.invoice.fields.id') }}
                                </th>
                               <th>
                                   Sous total
                               </th>
                                <th>
                                    {{ trans('cruds.invoice.fields.total') }}
                                </th>
                                
                                <th>
                                    {{ trans('cruds.invoice.fields.deadline') }}
                                </th>
                                <th>
                                   Date création
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student->studentInvoices as $invoice )
                            <td>{{$invoice->id}}</td>
                            <td>{{$invoice->total}}</td>
                            <td>{{$invoice->total_to_pay}}</td>
                            <td>{{$invoice->deadline}}</td>
                            <td>{{$invoice->created_at}}</td>
                            <td>@if($invoice->status ==0)<label class="label label-success"> Unpaid</label> @else Paid @endif</td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header">
                    {{ trans('cruds.lesson.title') }}
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>

    </div>


@endsection
@section('modals')
@include('tenant.students.includes.modals',['student'=>$student,'formations'=>$formations,'promotions'=>$promotions]);
@endsection
