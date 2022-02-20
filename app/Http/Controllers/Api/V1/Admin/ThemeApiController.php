<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreThemeRequest;
use App\Http\Requests\UpdateThemeRequest;
use App\Http\Resources\Admin\ThemeResource;
use App\Models\Theme;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThemeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('theme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ThemeResource(Theme::with(['tenants'])->get());
    }

    public function store(StoreThemeRequest $request)
    {
        $theme = Theme::create($request->all());
        $theme->tenants()->sync($request->input('tenants', []));
        if ($request->input('screenshot', false)) {
            $theme->addMedia(storage_path('tmp/uploads/' . basename($request->input('screenshot'))))->toMediaCollection('screenshot');
        }

        return (new ThemeResource($theme))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Theme $theme)
    {
        abort_if(Gate::denies('theme_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ThemeResource($theme->load(['tenants']));
    }

    public function update(UpdateThemeRequest $request, Theme $theme)
    {
        $theme->update($request->all());
        $theme->tenants()->sync($request->input('tenants', []));
        if ($request->input('screenshot', false)) {
            if (!$theme->screenshot || $request->input('screenshot') !== $theme->screenshot->file_name) {
                if ($theme->screenshot) {
                    $theme->screenshot->delete();
                }
                $theme->addMedia(storage_path('tmp/uploads/' . basename($request->input('screenshot'))))->toMediaCollection('screenshot');
            }
        } elseif ($theme->screenshot) {
            $theme->screenshot->delete();
        }

        return (new ThemeResource($theme))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Theme $theme)
    {
        abort_if(Gate::denies('theme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $theme->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
