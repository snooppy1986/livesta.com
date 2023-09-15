<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => "min: 3 | max: 255 | string",
            'surname '=> "min: 3 | max: 255 | string",
            'phone' => "numeric",
            'email' => "string | email | max:255 | unique:users,email,".$this->user->id,
            'image' => 'nullable',
            'remove_image' => 'nullable'
        ];
    }
}
