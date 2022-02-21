<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroyTenantRequest;
use App\Http\Requests\Admin\StoreTenantRequest;
use App\Http\Requests\Admin\UpdateTenantRequest;
use App\Models\Package;
use App\Models\Tenant;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TenantController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tenant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Tenant::with(['package', 'created_by'])->select(sprintf('%s.*', (new Tenant())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tenant_show';
                $editGate = 'tenant_edit';
                $deleteGate = 'tenant_delete';
                $crudRoutePart = 'tenants';

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
            $table->editColumn('store_name', function ($row) {
                return $row->store_name ? $row->store_name : '';
            });
            $table->editColumn('store_logo', function ($row) {
                if ($photo = $row->store_logo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('is_active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_active ? 'checked' : null) . '>';
            });

            $table->editColumn('store_location', function ($row) {
                return $row->store_location ? $row->store_location : '';
            });
            $table->addColumn('package_title', function ($row) {
                return $row->package ? $row->package->title : '';
            });

            $table->editColumn('package.price', function ($row) {
                return $row->package ? (is_string($row->package) ? $row->package : $row->package->price) : '';
            });
            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'store_logo', 'is_active', 'package', 'created_by']);

            return $table->make(true);
        }

        return view('admin.tenants.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tenant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packages = Package::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tenants.create', compact('created_bies', 'packages'));
    }

    public function store(StoreTenantRequest $request)
    {
        $tenant = Tenant::create($request->all());

        if ($request->input('store_logo', false)) {
            $tenant->addMedia(storage_path('tmp/uploads/' . basename($request->input('store_logo'))))->toMediaCollection('store_logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $tenant->id]);
        }

        return redirect()->route('admin.tenants.index');
    }

    public function edit(Tenant $tenant)
    {
        abort_if(Gate::denies('tenant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packages = Package::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tenant->load('package', 'created_by');

        return view('admin.tenants.edit', compact('created_bies', 'packages', 'tenant'));
    }

    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        $tenant->update($request->all());

        if ($request->input('store_logo', false)) {
            if (!$tenant->store_logo || $request->input('store_logo') !== $tenant->store_logo->file_name) {
                if ($tenant->store_logo) {
                    $tenant->store_logo->delete();
                }
                $tenant->addMedia(storage_path('tmp/uploads/' . basename($request->input('store_logo'))))->toMediaCollection('store_logo');
            }
        } elseif ($tenant->store_logo) {
            $tenant->store_logo->delete();
        }

        return redirect()->route('admin.tenants.index');
    }

    public function show(Tenant $tenant)
    {
        abort_if(Gate::denies('tenant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenant->load('package', 'created_by', 'tenantDomains', 'tenantPayments', 'tenantThemes');

        return view('admin.tenants.show', compact('tenant'));
    }

    public function destroy(Tenant $tenant)
    {
        abort_if(Gate::denies('tenant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenant->delete();

        return back();
    }

    public function massDestroy(MassDestroyTenantRequest $request)
    {
        Tenant::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('tenant_create') && Gate::denies('tenant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Tenant();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
