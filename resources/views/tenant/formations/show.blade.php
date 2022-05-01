@extends('layouts.tenant')
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <img src="{{ $formation->featured_image_url }}" alt="{{ $formation->title }}" class="card-img-top"
                    style="width: 100%;
                                    aspect-ratio: 16 / 9;
                                    object-fit: cover;">
                <div class="card-header">
                    <h5 class="card-title">{{ $formation->title }}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td>{{ __('cruds.price') }}</td>
                            <td><strong>{{ $formation->price_formatted }}</strong></td>

                        </tr>
                        <tr>
                            <td>{{ __('cruds.duration') }}</td>
                            <td><strong>{{ $formation->duration_formatted }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title"> {{ __('Promotions') }}</div>
                    <div class="card-toolbar">
                        <button class="btn btn-sm btn-success" data-bs-toggle="offcanvas"
                            data-bs-target="#createPromotionCanva" aria-controls="createPromotionCanva">
                            <i class="fa fa-plus"></i>
                            {{ __('Add new') }}
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th> {{ __('Name') }} </th>
                                <th> {{ __('Starting date') }} </th>
                                <th> {{ __('Ending date') }} </th>
                                <th> {{ __('Price') }} </th>
                                <th> {{ __('Actions') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formation->promotions as $promotion)
                                <tr>
                                    <td> {{ $promotion->name }} </td>
                                    <td> {{ $promotion->starting_date }} </td>
                                    <td> {{ $promotion->ending_date }} </td>
                                    <td> {{ $promotion->price }} </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-clean"><i class="fa fa-trash"></i></a>
                                        <a href="" class="btn btn-sm btn-clean"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title"> {{ __('Groups') }}</div>
                    <div class="card-toolbar">
                        <button class="btn btn-sm btn-success" data-bs-toggle="offcanvas" data-bs-target="#createGroupCanva"
                            aria-controls="createGroupCanva">
                            <i class="fa fa-plus"></i>
                            {{ __('Add new') }}
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th> {{ __('Name') }} </th>
                                <th> {{ __('Promotion') }} </th>
                                <th> {{ __('Students') }} </th>

                                <th> {{ __('Actions') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formation->groups as $group)
                                <tr>
                                    <td> <a href="{{route('tenant.groups.show',['group'=>$group])}}">  {{ $group->name }} </a> </td>
                                    <td> {{ $group->promotion->name }} </td>
                                    <td>  <span class="badge rounded-pill bg-primary">{{ $group->students->count() }}</span>  </td>
                                   
                                    <td>
                                        <a href="" class="btn btn-sm btn-clean"><i class="fa fa-users"></i></a>
                                        <a href="" class="btn btn-sm btn-clean"><i class="fa fa-trash"></i></a>
                                        <a href="" class="btn btn-sm btn-clean"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('canvas')
    @include('tenant.formations.offcanvas.create-promotion', [
        'formation' => $formation,
    ])
    @include('tenant.formations.offcanvas.create-group', [
        'promotions' => $formation->promotions,
    ])
@endsection
