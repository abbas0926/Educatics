<?php

namespace App\Http\Requests\Tenant;

use App\Models\LeadInteraction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLeadInteractionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lead_interaction_create');
    }

    public function rules()
    {
        return [
            'lead_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
