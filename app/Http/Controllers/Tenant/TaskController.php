<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyTaskRequest;
use App\Http\Requests\Tenant\StoreTaskRequest;
use App\Http\Requests\Tenant\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskTag;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::with(['status', 'tags', 'assigned_to', 'media'])->get();

        return view('tenant.tasks.index', compact('tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::pluck('name', 'id');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.tasks.create', compact('assigned_tos', 'statuses', 'tags'));
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());
        $task->tags()->sync($request->input('tags', []));
        if ($request->input('attachment', false)) {
            $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $task->id]);
        }

        return redirect()->route('tenant.tasks.index');
    }


    public function storeFromCalendar(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());
        $task->tags()->sync($request->input('tags', []));
        if ($request->input('attachment', false)) {
            $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $task->id]);
        }

        $events = Task::whereNotNull('due_date')->get();
        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $tags = TaskTag::pluck('name', 'id');
        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('tenant.tasksCalendars.index', compact('events','statuses','tags','assigned_tos'));
    }
    
    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::pluck('name', 'id');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $task->load('status', 'tags', 'assigned_to');

        return view('tenant.tasks.edit', compact('assigned_tos', 'statuses', 'tags', 'task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        $task->tags()->sync($request->input('tags', []));
        if ($request->input('attachment', false)) {
            if (!$task->attachment || $request->input('attachment') !== $task->attachment->file_name) {
                if ($task->attachment) {
                    $task->attachment->delete();
                }
                $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($task->attachment) {
            $task->attachment->delete();
        }

        return redirect()->route('tenant.tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->load('status', 'tags', 'assigned_to');

        return view('tenant.tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
        Task::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('task_create') && Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Task();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
