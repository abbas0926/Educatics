<?php

namespace App\Http\Requests\Tenant;

use App\Models\Lead;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLeadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lead_create');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'nullable',
            ],
            'last_name' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'formations.*' => [
                'integer',
            ],
            'formations' => [
                'array',
            ],
            'events.*' => [
                'integer',
            ],
            'events' => [
                'array',
            ],
        ];
    }
}
