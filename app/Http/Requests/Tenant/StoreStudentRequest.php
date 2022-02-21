<?php

namespace App\Http\Requests\Tenant;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_create');
    }

    public function rules()
    {
        return [
            'attachements' => [
                'array',
            ],
            'first_name' => [
                'string',
                'nullable',
            ],
            'last_name' => [
                'string',
                'nullable',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'birthdate' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'adresse' => [
                'string',
                'nullable',
            ],
            'study_level' => [
                'string',
                'nullable',
            ],
            'establishement' => [
                'string',
                'nullable',
            ],
            'matricule' => [
                'string',
                'nullable',
            ],
        ];
    }
}
