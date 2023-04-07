<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required','string','max:50'],
            'last_name'  => ['required','string','max:50'],
            'email'      => ['required','email'],
            'phone'      => ['nullable'],
            'password'   => ['required','min:8','max:20','confirmed'],
        ];
    }
}
