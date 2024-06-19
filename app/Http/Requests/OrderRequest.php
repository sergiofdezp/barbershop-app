<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_date' => 'required | date',
            'order_hour' => 'required | string',
            'name' => 'required | string',
            'phone' => 'required | integer',
            'service_id' => 'required | integer',
            'total_price' => 'required | min:0 | max:100',
        ];
    }
}
