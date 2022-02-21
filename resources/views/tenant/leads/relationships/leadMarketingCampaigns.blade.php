@can('marketing_campaign_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.marketing-campaigns.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.marketingCampaign.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.marketingCampaign.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-leadMarketingCampaigns">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.manager') }}
                        </th>
                        <th>
                            {{ trans('cruds.marketingCampaign.fields.budget') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marketingCampaigns as $key => $marketingCampaign)
                        <tr data-entry-id="{{ $marketingCampaign->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $marketingCampaign->id ?? '' }}
                            </td>
                            <td>
                                {{ $marketingCampaign->title ?? '' }}
                            </td>
                            <td>
                                {{ $marketingCampaign->manager->name ?? '' }}
                            </td>
                            <td>
                                {{ $marketingCampaign->budget ?? '' }}
                            </td>
                            <td>
                                @can('marketing_campaign_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('tenant.marketing-campaigns.show', $marketingCampaign->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('marketing_campaign_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('tenant.marketing-campaigns.edit', $marketingCampaign->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('marketing_campaign_delete')
                                    <form action="{{ route('tenant.marketing-campaigns.destroy', $marketingCampaign->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('marketing_campaign_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.marketing-campaigns.massDestroy') }}",
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
  let table = $('.datatable-leadMarketingCampaigns:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection