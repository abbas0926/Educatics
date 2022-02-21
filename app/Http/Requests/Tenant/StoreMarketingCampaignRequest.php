<?php

namespace App\Http\Requests\Tenant;

use App\Models\MarketingCampaign;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMarketingCampaignRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('marketing_campaign_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'gallery' => [
                'array',
            ],
            'formations.*' => [
                'integer',
            ],
            'formations' => [
                'array',
            ],
            'events.*' => [
                'integer',
            ],
            'events' => [
                'array',
            ],
            'leads.*' => [
                'integer',
            ],
            'leads' => [
                'array',
            ],
            'expenses.*' => [
                'integer',
            ],
            'expenses' => [
                'array',
            ],
        ];
    }
}
