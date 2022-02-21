<?php

namespace App\Http\Requests\Tenant;

use App\Models\Salary;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSalaryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('salary_edit');
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'taken_salary' => [
                'required',
            ],
        ];
    }
}
