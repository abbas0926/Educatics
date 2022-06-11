@extends('layouts.tenant')
@section('content')
<h3 class="page-title">{{ trans('global.systemCalendar') }}</h3>
<div class="card">
    <div class="card-header">
        {{ trans('global.systemCalendar') }}
        @can('student_create')
        <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#EditFormationModal"
            aria-controls="createTaskCanva">Add lesson
        </button>
    @endcan
    </div>

    <div class="card-body">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css'/>

        <div id='calendar'></div>
    </div>
 
</div>



@endsection
@section('modals')
@include('tenant.calendar.includes.modals',['classromms'=>$classrooms,'groups'=>$groups]);

@endsection
@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: events,


            })
        });
</script>
@stop