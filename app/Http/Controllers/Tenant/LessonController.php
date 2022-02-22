<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyLessonRequest;
use App\Http\Requests\Tenant\StoreLessonRequest;
use App\Http\Requests\Tenant\UpdateLessonRequest;
use App\Models\Classroom;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Teacher;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LessonController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Lesson::with(['group', 'teacher', 'classroom', 'presence_students'])->select(sprintf('%s.*', (new Lesson())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lesson_show';
                $editGate = 'lesson_edit';
                $deleteGate = 'lesson_delete';
                $crudRoutePart = 'lessons';

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
            $table->addColumn('group_name', function ($row) {
                return $row->group ? $row->group->name : '';
            });

            $table->addColumn('teacher_first_name', function ($row) {
                return $row->teacher ? $row->teacher->first_name : '';
            });

            $table->editColumn('teacher.last_name', function ($row) {
                return $row->teacher ? (is_string($row->teacher) ? $row->teacher : $row->teacher->last_name) : '';
            });

            $table->addColumn('classroom_name', function ($row) {
                return $row->classroom ? $row->classroom->name : '';
            });

            $table->editColumn('done', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->done ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'group', 'teacher', 'classroom', 'done']);

            return $table->make(true);
        }

        return view('tenant.lessons.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teachers = Teacher::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classrooms = Classroom::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $presence_students = Student::pluck('first_name', 'id');

        return view('tenant.lessons.create', compact('classrooms', 'groups', 'presence_students', 'teachers'));
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $lesson->id]);
        }

        return redirect()->route('tenant.lessons.index');
    }

    public function edit(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teachers = Teacher::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classrooms = Classroom::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $presence_students = Student::pluck('first_name', 'id');

        $lesson->load('group', 'teacher', 'classroom', 'presence_students');

        return view('tenant.lessons.edit', compact('classrooms', 'groups', 'lesson', 'presence_students', 'teachers'));
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

        return redirect()->route('tenant.lessons.index');
    }

    public function show(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->load('group', 'teacher', 'classroom', 'presence_students');

        return view('tenant.lessons.show', compact('lesson'));
    }

    public function destroy(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonRequest $request)
    {
        Lesson::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('lesson_create') && Gate::denies('lesson_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Lesson();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
