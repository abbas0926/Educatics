<?php

namespace App\Http\Requests\Tenant;

use App\Models\LeadInteraction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLeadInteractionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lead_interaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lead_interactions,id',
        ];
    }
}
