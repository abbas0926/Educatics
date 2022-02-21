<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StoreClassroomRequest;
use App\Http\Requests\Tenant\UpdateClassroomRequest;
use App\Http\Resources\Tenant\ClassroomResource;
use App\Models\Classroom;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClassroomApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('classroom_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClassroomResource(Classroom::all());
    }

    public function store(StoreClassroomRequest $request)
    {
        $classroom = Classroom::create($request->all());

        return (new ClassroomResource($classroom))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Classroom $classroom)
    {
        abort_if(Gate::denies('classroom_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClassroomResource($classroom);
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->all());

        return (new ClassroomResource($classroom))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Classroom $classroom)
    {
        abort_if(Gate::denies('classroom_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classroom->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
