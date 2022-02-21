<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StoreFormationRequest;
use App\Http\Requests\Tenant\UpdateFormationRequest;
use App\Http\Resources\Tenant\FormationResource;
use App\Models\Formation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('formation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FormationResource(Formation::all());
    }

    public function store(StoreFormationRequest $request)
    {
        $formation = Formation::create($request->all());

        if ($request->input('featured_image', false)) {
            $formation->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        foreach ($request->input('syllabus', []) as $file) {
            $formation->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('syllabus');
        }

        return (new FormationResource($formation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Formation $formation)
    {
        abort_if(Gate::denies('formation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FormationResource($formation);
    }

    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        $formation->update($request->all());

        if ($request->input('featured_image', false)) {
            if (!$formation->featured_image || $request->input('featured_image') !== $formation->featured_image->file_name) {
                if ($formation->featured_image) {
                    $formation->featured_image->delete();
                }
                $formation->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($formation->featured_image) {
            $formation->featured_image->delete();
        }

        if (count($formation->syllabus) > 0) {
            foreach ($formation->syllabus as $media) {
                if (!in_array($media->file_name, $request->input('syllabus', []))) {
                    $media->delete();
                }
            }
        }
        $media = $formation->syllabus->pluck('file_name')->toArray();
        foreach ($request->input('syllabus', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $formation->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('syllabus');
            }
        }

        return (new FormationResource($formation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Formation $formation)
    {
        abort_if(Gate::denies('formation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
