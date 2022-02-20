@extends('layouts.admin')
@section('content')
@can('tenant_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tenants.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tenant.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tenant.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Tenant">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.tenant.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.tenant.fields.store_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.tenant.fields.store_logo') }}
                    </th>
                    <th>
                        {{ trans('cruds.tenant.fields.phone_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.tenant.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.tenant.fields.is_active') }}
                    </th>
                    <th>
                        {{ trans('cruds.tenant.fields.valid_until') }}
                    </th>
                    <th>
                        {{ trans('cruds.tenant.fields.store_location') }}
                    </th>
                    <th>
                        {{ trans('cruds.tenant.fields.package') }}
                    </th>
                    <th>
                        {{ trans('cruds.package.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.tenant.fields.created_by') }}
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
@can('tenant_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tenants.massDestroy') }}",
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
    ajax: "{{ route('admin.tenants.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'store_name', name: 'store_name' },
{ data: 'store_logo', name: 'store_logo', sortable: false, searchable: false },
{ data: 'phone_number', name: 'phone_number' },
{ data: 'email', name: 'email' },
{ data: 'is_active', name: 'is_active' },
{ data: 'valid_until', name: 'valid_until' },
{ data: 'store_location', name: 'store_location' },
{ data: 'package_title', name: 'package.title' },
{ data: 'package.price', name: 'package.price' },
{ data: 'created_by_name', name: 'created_by.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Tenant').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection