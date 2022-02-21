@can('employee_presence_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.employee-presences.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.employeePresence.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.employeePresence.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-employeeEmployeePresences">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.employeePresence.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeePresence.fields.employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeePresence.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeePresence.fields.note') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeePresence.fields.started_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeePresence.fields.ended_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employeePresences as $key => $employeePresence)
                        <tr data-entry-id="{{ $employeePresence->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $employeePresence->id ?? '' }}
                            </td>
                            <td>
                                {{ $employeePresence->employee->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\EmployeePresence::STATUS_SELECT[$employeePresence->status] ?? '' }}
                            </td>
                            <td>
                                {{ $employeePresence->note ?? '' }}
                            </td>
                            <td>
                                {{ $employeePresence->started_at ?? '' }}
                            </td>
                            <td>
                                {{ $employeePresence->ended_at ?? '' }}
                            </td>
                            <td>
                                @can('employee_presence_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('tenant.employee-presences.show', $employeePresence->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('employee_presence_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('tenant.employee-presences.edit', $employeePresence->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('employee_presence_delete')
                                    <form action="{{ route('tenant.employee-presences.destroy', $employeePresence->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('employee_presence_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.employee-presences.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-employeeEmployeePresences:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection