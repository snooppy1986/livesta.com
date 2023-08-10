<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'product_id'=>'integer',
            'advantage'=>'string|max:1024|min:2|nullable',
            'flaws'=>'string|max:1024|min:2|nullable',
            'message'=>'string|max:2048|min:2|nullable',
            'name_surname'=>'required|string|max:1024|min:2|nullable',
            'email'=>'required|email|max:255|nullable',
            'rating'=>'integer',
        ];
    }
}
