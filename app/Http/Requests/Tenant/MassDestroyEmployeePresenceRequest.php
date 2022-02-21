<?php

namespace App\Http\Requests\Tenant;

use App\Models\EmployeePresence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEmployeePresenceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('employee_presence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:employee_presences,id',
        ];
    }
}
