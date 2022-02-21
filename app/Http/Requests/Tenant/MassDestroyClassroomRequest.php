<?php

namespace App\Http\Requests\Tenant;

use App\Models\Classroom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClassroomRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('classroom_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:classrooms,id',
        ];
    }
}
