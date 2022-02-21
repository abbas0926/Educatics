<?php

namespace App\Http\Requests\Tenant;

use App\Models\Promotion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePromotionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('promotion_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'formation_id' => [
                'required',
                'integer',
            ],
            'starting_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'ending_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'students.*' => [
                'integer',
            ],
            'students' => [
                'array',
            ],
        ];
    }
}
