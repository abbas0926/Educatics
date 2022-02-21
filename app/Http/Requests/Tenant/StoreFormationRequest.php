<?php

namespace App\Http\Requests\Tenant;

use App\Models\Formation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFormationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('formation_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
            ],
            'duration' => [
                'string',
                'nullable',
            ],
            'syllabus' => [
                'array',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
