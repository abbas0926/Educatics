<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyClassroomRequest;
use App\Http\Requests\Tenant\StoreClassroomRequest;
use App\Http\Requests\Tenant\UpdateClassroomRequest;
use App\Models\Classroom;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClassroomController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('classroom_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Classroom::query()->select(sprintf('%s.*', (new Classroom())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'classroom_show';
                $editGate = 'classroom_edit';
                $deleteGate = 'classroom_delete';
                $crudRoutePart = 'classrooms';

                return view('partials.tenant.datatablesActions', compact(
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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('capacity', function ($row) {
                return $row->capacity ? $row->capacity : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('tenant.classrooms.index');
    }

    public function create()
    {
        abort_if(Gate::denies('classroom_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.classrooms.create');
    }

    public function store(StoreClassroomRequest $request)
    {
        $classroom = Classroom::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $classroom->id]);
        }

        return redirect()->route('tenant.classrooms.index');
    }

    public function edit(Classroom $classroom)
    {
        abort_if(Gate::denies('classroom_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.classrooms.edit', compact('classroom'));
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->all());

        return redirect()->route('tenant.classrooms.index');
    }

    public function show(Classroom $classroom)
    {
        abort_if(Gate::denies('classroom_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classroom->load('classroomLessons');

        return view('tenant.classrooms.show', compact('classroom'));
    }

    public function destroy(Classroom $classroom)
    {
        abort_if(Gate::denies('classroom_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classroom->delete();

        return back();
    }

    public function massDestroy(MassDestroyClassroomRequest $request)
    {
        Classroom::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('classroom_create') && Gate::denies('classroom_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Classroom();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
