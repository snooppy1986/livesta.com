<?php

namespace App\Http\Requests\MainSlider;

use Illuminate\Foundation\Http\FormRequest;

class MainSliderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image'=>'required|file|mimes:jpg,jpeg,png',
            'title'=>'required | min: 4 | max: 19 | string',
            'content'=>'nullable | string | max: 512',
            'product_id' => 'nullable'
        ];
    }
}
