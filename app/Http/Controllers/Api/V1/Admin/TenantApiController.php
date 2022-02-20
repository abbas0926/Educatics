<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Http\Resources\Admin\TenantResource;
use App\Models\Tenant;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('tenant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TenantResource(Tenant::with(['package', 'created_by'])->get());
    }

    public function store(StoreTenantRequest $request)
    {
        $tenant = Tenant::create($request->all());

        if ($request->input('store_logo', false)) {
            $tenant->addMedia(storage_path('tmp/uploads/' . basename($request->input('store_logo'))))->toMediaCollection('store_logo');
        }

        return (new TenantResource($tenant))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Tenant $tenant)
    {
        abort_if(Gate::denies('tenant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TenantResource($tenant->load(['package', 'created_by']));
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

        return (new TenantResource($tenant))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Tenant $tenant)
    {
        abort_if(Gate::denies('tenant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenant->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
