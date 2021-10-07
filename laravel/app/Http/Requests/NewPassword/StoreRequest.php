<?php

namespace App\Http\Requests\NewPassword;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required|string',
            'email' => 'required|string|max:255|email:rfc,strict,spoof',
            'password' => ['required', 'max:255', 'confirmed', Password::min(8)],
        ];
    }
}
