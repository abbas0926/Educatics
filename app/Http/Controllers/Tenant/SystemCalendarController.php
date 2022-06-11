<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Group;
use App\Models\Teacher;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Lesson',
            'date_field' => 'start_at',
            'field'      => 'id',
            'prefix'     => 'Lessons',
            'suffix'     => '',
            'route'      => 'tenant.lessons.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }
       $classrooms=Classroom::all();
       $groups=Group::all();
       $teachers= Teacher::all();
       
        return view('tenant.calendar.calendar', compact('events','classrooms','groups','teachers'));
    }
}
