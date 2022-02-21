<?php

namespace App\Http\Requests\Admin;

use App\Models\Domain;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDomainRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('domain_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:domains,id',
        ];
    }
}
