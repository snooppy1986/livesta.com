<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'title' => 'required|min:2|max:512|string',
            'about' => 'required|max:4096',
            'code' => 'required',
            'parent_id' => 'nullable | array',
            'price_balls' => 'nullable',
            'price_special' => 'required',
            'price_through' => 'required',
            'price_discount' => 'nullable',
            'application' => 'max:2048',
            'brand' => 'max:2048',
            'country' => 'max:2048',
            'composition' => 'max:2048',
            'weight' => 'max:128',
            'keywords' => 'nullable|string|max:1024',
            'description' => 'nullable|string|max:1024',
            'productImage' => 'nullable|image',
            'rating' => 'nullable',
            'brand_id' => 'nullable | integer',
            'gender' => 'nullable | string',
            'catalog_id' => 'nullable | integer',
            'warning' => 'nullable',
            'related_product' => 'nullable | array'
        ];
    }
}
