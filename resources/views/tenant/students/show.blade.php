@extends('layouts.tenant')
@section('content')
    <div class="row">
        <div class="col-md-5 col-lg-3">
            <div class="card">
                <div class="card-header text-center">
                    <img src="{{$student->photo_url}}" class="img-fluid rounded-circle" alt="{{ $student->fullName }}" />
                    <div class="card-title"> {{ $student->fullName }} </div>
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

                        </tbody>
                    </table>



                </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-9">
            <div class="card mb-2">
                <div class="card-header">
                    {{ trans('cruds.invoice.title') }}
                </div>
                <div class="card-body">

                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header">
                    {{ trans('cruds.group.title') }}
                </div>
                <div class="card-body">

                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header">
                    {{ trans('cruds.promotion.title') }}
                </div>
                <div class="card-body">

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
