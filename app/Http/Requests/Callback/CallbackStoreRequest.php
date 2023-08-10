<?php

namespace App\Http\Requests\Callback;

use Illuminate\Foundation\Http\FormRequest;

class CallbackStoreRequest extends FormRequest
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
            'name'=> 'required|string|min:2|max:64',
            'surname'=> 'nullable|string|max:64',
            'email'=> 'required|email|max:128',
            'message'=> 'required|min:10|max:3000|string'
        ];
    }
}
