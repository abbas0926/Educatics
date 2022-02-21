@can('promotion_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.promotions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.promotion.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.promotion.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-formationPromotions">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.promotion.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.promotion.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.promotion.fields.formation') }}
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
                    @foreach($promotions as $key => $promotion)
                        <tr data-entry-id="{{ $promotion->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $promotion->id ?? '' }}
                            </td>
                            <td>
                                {{ $promotion->name ?? '' }}
                            </td>
                            <td>
                                {{ $promotion->formation->title ?? '' }}
                            </td>
                            <td>
                                {{ $promotion->starting_date ?? '' }}
                            </td>
                            <td>
                                {{ $promotion->ending_date ?? '' }}
                            </td>
                            <td>
                                @can('promotion_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('tenant.promotions.show', $promotion->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('promotion_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('tenant.promotions.edit', $promotion->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('promotion_delete')
                                    <form action="{{ route('tenant.promotions.destroy', $promotion->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('promotion_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.promotions.massDestroy') }}",
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
  let table = $('.datatable-formationPromotions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection