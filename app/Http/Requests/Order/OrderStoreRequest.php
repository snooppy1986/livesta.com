<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required | min: 3 | max: 255 | string',
            'surname' => 'required | min: 3 | max: 255 | string',
            'phone' => 'required | numeric | digits:10',
            'email' => 'max: 255 | string',
            'notes' => 'max: 1024',
            'products' => 'array',
            'products_ids' => 'array',
            'deliveryMethod' => 'nullable | string',
            'deliveryAddress' => 'nullable | array',
            'paymentMethod' => 'nullable | string',
            'total_price' => 'nullable | integer',
            'user_id' => 'nullable | integer'
        ];
    }
}
