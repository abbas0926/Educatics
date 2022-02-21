<?php

namespace App\Http\Requests\Admin;

use App\Models\Theme;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyThemeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('theme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:themes,id',
        ];
    }
}
