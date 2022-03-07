 @extends('layouts.tenant')
@section('content')
{{-- @can('lesson_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.lessons.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.presences.presences') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.lesson.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Lesson">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.lesson.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.lesson.fields.group') }}
                    </th>
                    <th>
                        {{ trans('cruds.lesson.fields.teacher') }}
                    </th>
                    <th>
                        {{ trans('cruds.teacher.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.lesson.fields.start_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.lesson.fields.ends_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.lesson.fields.classroom') }}
                    </th>
                    <th>
                        {{ trans('cruds.lesson.fields.done') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('lesson_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.presences.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('tenant.presences.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'group_name', name: 'group.name' },
{ data: 'teacher_first_name', name: 'teacher.first_name' },
{ data: 'teacher.last_name', name: 'teacher.last_name' },
{ data: 'start_at', name: 'start_at' },
{ data: 'ends_at', name: 'ends_at' },
{ data: 'classroom_name', name: 'classroom.name' },
{ data: 'done', name: 'done' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Lesson').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script> --}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.lesson.title') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Page">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.group.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.teacher.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.lesson.fields.time') }}
                        </th>
                        <th>
                            {{ trans('cruds.lesson.fields.ends_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessons as $key => $page)
                        <tr data-entry-id="{{ $page->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $page->group->name ?? '' }}
                            </td>
                            <td>
                                {{ $page->teacher->last_name.' '.$page->teacher->first_name  ?? '' }}
                            </td>
                            <td>
                                {{ Carbon\Carbon::parse($page->start_at)->format('h:i').'-'.Carbon\Carbon::parse($page->end_at)->format('h:i') ?? '' }}
                            </td>
                            <td>
                                {{ $page->meta_data ?? '' }}
                            </td>
                            <td>
                                @can('page_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pages.show', $page->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('page_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pages.edit', $page->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('page_delete')
                                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection