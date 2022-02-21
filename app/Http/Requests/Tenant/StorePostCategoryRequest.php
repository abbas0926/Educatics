<?php

namespace App\Http\Requests\Tenant;

use App\Models\PostCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_category_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'subtitle' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
