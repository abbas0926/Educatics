<?php

namespace App\Http\Requests\Tenant;

use App\Models\Formation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

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
            'payment_frequency'=>['nullable', Rule::in(array_keys(Formation::PAYMENT_TYPE)) ],
            'duration_type'=>['nullable', Rule::in(array_keys(Formation::DURATION_SELECT )) ],
        ];
    }
}
