@can('salary_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.salaries.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.salary.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.salary.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-employeeSalaries">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.salary.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.salary.fields.employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.salary.fields.month') }}
                        </th>
                        <th>
                            {{ trans('cruds.salary.fields.taken_salary') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salaries as $key => $salary)
                        <tr data-entry-id="{{ $salary->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $salary->id ?? '' }}
                            </td>
                            <td>
                                {{ $salary->employee->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $salary->employee->first_name ?? '' }}
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
@can('salary_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.salaries.massDestroy') }}",
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
  let table = $('.datatable-employeeSalaries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection