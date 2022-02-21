<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyDomainRequest;
use App\Http\Requests\Admin\StoreDomainRequest;
use App\Http\Requests\Admin\UpdateDomainRequest;
use App\Models\Domain;
use App\Models\Tenant;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DomainController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('domain_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Domain::with(['tenant', 'created_by'])->select(sprintf('%s.*', (new Domain())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'domain_show';
                $editGate = 'domain_edit';
                $deleteGate = 'domain_delete';
                $crudRoutePart = 'domains';

                return view('partials.admin.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('domain', function ($row) {
                return $row->domain ? $row->domain : '';
            });
            $table->addColumn('tenant_store_name', function ($row) {
                return $row->tenant ? $row->tenant->store_name : '';
            });

            $table->editColumn('domain_type', function ($row) {
                return $row->domain_type ? Domain::DOMAIN_TYPE_SELECT[$row->domain_type] : '';
            });
            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'tenant', 'created_by']);

            return $table->make(true);
        }

        return view('admin.domains.index');
    }

    public function create()
    {
        abort_if(Gate::denies('domain_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenants = Tenant::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.domains.create', compact('created_bies', 'tenants'));
    }

    public function store(StoreDomainRequest $request)
    {
        $domain = Domain::create($request->all());

        return redirect()->route('admin.domains.index');
    }

    public function edit(Domain $domain)
    {
        abort_if(Gate::denies('domain_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenants = Tenant::pluck('store_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $domain->load('tenant', 'created_by');

        return view('admin.domains.edit', compact('domain', 'tenants'));
    }

    public function update(UpdateDomainRequest $request, Domain $domain)
    {
        $domain->update($request->all());

        return redirect()->route('admin.domains.index');
    }

    public function show(Domain $domain)
    {
        abort_if(Gate::denies('domain_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $domain->load('tenant', 'created_by');

        return view('admin.domains.show', compact('domain'));
    }

    public function destroy(Domain $domain)
    {
        abort_if(Gate::denies('domain_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $domain->delete();

        return back();
    }

    public function massDestroy(MassDestroyDomainRequest $request)
    {
        Domain::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
