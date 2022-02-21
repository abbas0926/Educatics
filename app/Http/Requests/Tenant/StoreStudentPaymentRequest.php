<?php

namespace App\Http\Requests\Tenant;

use App\Models\StudentPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_payment_create');
    }

    public function rules()
    {
        return [
            'amount' => [
                'required',
            ],
            'payment_method' => [
                'required',
            ],
            'attachement' => [
                'array',
            ],
        ];
    }
}
