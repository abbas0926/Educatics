<?php

namespace App\Http\Requests\Tenant;

use App\Models\EmployeePresence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmployeePresenceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_presence_edit');
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'note' => [
                'string',
                'nullable',
            ],
            'started_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'ended_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
