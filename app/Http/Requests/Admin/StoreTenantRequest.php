<?php

namespace App\Http\Requests\Admin;

use App\Models\Tenant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTenantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tenant_create');
    }

    public function rules()
    {
        return [
            'store_name' => [
                'string',
                'nullable',
            ],
            'phone_number' => [
                'string',
                'nullable',
            ],
            'valid_until' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'created_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
