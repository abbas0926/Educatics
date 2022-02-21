<?php

namespace App\Http\Requests\Tenant;

use App\Models\InvoiceItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInvoiceItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('invoice_item_edit');
    }

    public function rules()
    {
        return [
            'quantity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
