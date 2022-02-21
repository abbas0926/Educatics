<?php

namespace App\Http\Requests\Tenant;

use App\Models\Promotion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPromotionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('promotion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:promotions,id',
        ];
    }
}
