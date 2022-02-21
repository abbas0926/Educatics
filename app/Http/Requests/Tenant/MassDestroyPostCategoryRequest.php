<?php

namespace App\Http\Requests\Tenant;

use App\Models\PostCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPostCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('post_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:post_categories,id',
        ];
    }
}
