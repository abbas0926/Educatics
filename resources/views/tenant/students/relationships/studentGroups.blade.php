@can('group_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.groups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.group.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.group.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-studentGroups">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.group.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.promotion') }}
                        </th>
                        <th>
                            {{ trans('cruds.promotion.fields.starting_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.promotion.fields.ending_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $key => $group)
                        <tr data-entry-id="{{ $group->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $group->id ?? '' }}
                            </td>
                            <td>
                                {{ $group->name ?? '' }}
                            </td>
                            <td>
                                {{ $group->promotion->name ?? '' }}
                            </td>
                            <td>
                                {{ $group->promotion->starting_date ?? '' }}
                            </td>
                            <td>
                                {{ $group->promotion->ending_date ?? '' }}
                            </td>
                            <td>
                                @can('group_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('tenant.groups.show', $group->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('tenant.groups.edit', $group->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('group_delete')
                                    <form action="{{ route('tenant.groups.destroy', $group->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.groups.massDestroy') }}",
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
  let table = $('.datatable-studentGroups:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection