<?php

namespace App\Http\Requests;

use App\Models\Payment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_create');
    }

    public function rules()
    {
        return [
            'price' => [
                'required',
            ],
            'tenant_id' => [
                'required',
                'integer',
            ],
            'package_id' => [
                'required',
                'integer',
            ],
            'created_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
