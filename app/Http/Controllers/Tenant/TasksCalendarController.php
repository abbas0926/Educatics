<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskTag;
use App\Models\User;

class TasksCalendarController extends Controller
{
    public function index()
    {
        $events = Task::whereNotNull('due_date')->get();
        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $tags = TaskTag::pluck('name', 'id');
        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('tenant.tasksCalendars.index', compact('events','statuses','tags','assigned_tos'));
    }
}
