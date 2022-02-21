<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\StorePackageRequest;
use App\Http\Requests\Admin\UpdatePackageRequest;
use App\Http\Resources\Admin\PackageResource;
use App\Models\Package;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PackageApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PackageResource(Package::with(['features'])->get());
    }

    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->all());
        $package->features()->sync($request->input('features', []));
        if ($request->input('featured_image', false)) {
            $package->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        return (new PackageResource($package))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Package $package)
    {
        abort_if(Gate::denies('package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PackageResource($package->load(['features']));
    }

    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->all());
        $package->features()->sync($request->input('features', []));
        if ($request->input('featured_image', false)) {
            if (!$package->featured_image || $request->input('featured_image') !== $package->featured_image->file_name) {
                if ($package->featured_image) {
                    $package->featured_image->delete();
                }
                $package->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($package->featured_image) {
            $package->featured_image->delete();
        }

        return (new PackageResource($package))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Package $package)
    {
        abort_if(Gate::denies('package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $package->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
