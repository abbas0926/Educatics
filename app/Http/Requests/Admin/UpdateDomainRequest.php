<?php

namespace App\Http\Requests\Admin;

use App\Models\Domain;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDomainRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('domain_edit');
    }

    public function rules()
    {
        return [
            'domain' => [
                'string',
                'max:255',
                'required',
                'unique:domains,domain,' . request()->route('domain')->id,
            ],
            'tenant_id' => [
                'required',
                'integer',
            ],
            'domain_type' => [
                'required',
            ],
        ];
    }
}
