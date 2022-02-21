<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StoreLessonRequest;
use App\Http\Requests\Tenant\UpdateLessonRequest;
use App\Http\Resources\Tenant\LessonResource;
use App\Models\Lesson;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lesson_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonResource(Lesson::with(['group', 'teacher', 'classroom', 'presence_students'])->get());
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->all());
        $lesson->presence_students()->sync($request->input('presence_students', []));
        foreach ($request->input('support', []) as $file) {
            $lesson->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('support');
        }

        foreach ($request->input('homework', []) as $file) {
            $lesson->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('homework');
        }

        return (new LessonResource($lesson))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonResource($lesson->load(['group', 'teacher', 'classroom', 'presence_students']));
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->all());
        $lesson->presence_students()->sync($request->input('presence_students', []));
        if (count($lesson->support) > 0) {
            foreach ($lesson->support as $media) {
                if (!in_array($media->file_name, $request->input('support', []))) {
                    $media->delete();
                }
            }
        }
        $media = $lesson->support->pluck('file_name')->toArray();
        foreach ($request->input('support', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lesson->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('support');
            }
        }

        if (count($lesson->homework) > 0) {
            foreach ($lesson->homework as $media) {
                if (!in_array($media->file_name, $request->input('homework', []))) {
                    $media->delete();
                }
            }
        }
        $media = $lesson->homework->pluck('file_name')->toArray();
        foreach ($request->input('homework', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lesson->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('homework');
            }
        }

        return (new LessonResource($lesson))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
