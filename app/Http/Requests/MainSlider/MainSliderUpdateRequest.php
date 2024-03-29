<?php

namespace App\Http\Requests\MainSlider;

use Illuminate\Foundation\Http\FormRequest;

class MainSliderUpdateRequest extends FormRequest
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
            'image'=>'file|mimes:jpg,jpeg,png',
            'title'=>'required | min: 4 | max: 19 | string',
            'content'=>'nullable | string | max: 512',
            'product_id' => 'nullable'
        ];
    }
}
