<?php

namespace App\Http\Requests\Admin;

use App\Models\Payment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_edit');
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
