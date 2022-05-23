<?php

namespace App\Http\Requests\Onboarding;

use Illuminate\Foundation\Http\FormRequest;

class RegisterTenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return is_null($this->honeypot);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subdomain' => ['required','unique:domains,domain'],
            'name' => ['required'],
            'last_name'=>['required'],
            'email' => ['required'],
            'password' => ['required','min:8'],
            'phone' => ['required']
        ];
    }
}
