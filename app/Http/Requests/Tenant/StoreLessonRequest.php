<?php

namespace App\Http\Requests\Tenant;

use App\Models\Lesson;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLessonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_create');
    }

    public function rules()
    {
        return [
            'group_id' => [
                'required',
                'integer',
            ],
            'teacher_id' => [
                'required',
                'integer',
            ],
            'start_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'ends_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'classroom_id' => [
                'required',
                'integer',
            ],
            'support' => [
                'array',
            ],
            'homework' => [
                'array',
            ],
            'presence_students.*' => [
                'integer',
            ],
            'presence_students' => [
                'array',
            ],
        ];
    }
}
