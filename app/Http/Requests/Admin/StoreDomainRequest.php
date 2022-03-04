<?php

namespace App\Http\Requests\Admin;

use App\Models\Domain;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDomainRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('domain_create');
    }

    public function rules()
    {
        return [
            'domain' => [
                'string',
                'max:255',
                'required',
                'unique:domains',
            ],
            'tenant_id' => [
                'required',
                
            ],
            'domain_type' => [
                'required',
            ],
            'created_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
