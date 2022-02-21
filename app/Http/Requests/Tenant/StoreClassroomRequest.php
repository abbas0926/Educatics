<?php

namespace App\Http\Requests\Tenant;

use App\Models\Classroom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClassroomRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('classroom_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'capacity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
