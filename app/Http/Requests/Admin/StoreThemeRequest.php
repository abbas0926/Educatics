<?php

namespace App\Http\Requests\Admin;

use App\Models\Theme;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreThemeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('theme_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'screenshot' => [
                'required',
            ],
            'tenants.*' => [
                'integer',
            ],
            'tenants' => [
                'array',
            ],
        ];
    }
}
