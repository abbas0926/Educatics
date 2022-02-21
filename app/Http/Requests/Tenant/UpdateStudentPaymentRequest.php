<?php

namespace App\Http\Requests\Tenant;

use App\Models\StudentPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_payment_edit');
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
