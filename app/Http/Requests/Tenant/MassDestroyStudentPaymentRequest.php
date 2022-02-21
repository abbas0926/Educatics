<?php

namespace App\Http\Requests\Tenant;

use App\Models\StudentPayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStudentPaymentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:student_payments,id',
        ];
    }
}
