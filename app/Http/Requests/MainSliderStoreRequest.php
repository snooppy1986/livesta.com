<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainSliderStoreRequest extends FormRequest
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
            'image'=>'required|file|mimes:jpg,jpeg,png',
            'title'=>'required | min: 4 | max: 19 | string',
            'content'=>'nullable | string | max: 512',
            'product_link' => 'required'
        ];
    }
}
