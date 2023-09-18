<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'gender' => 'required',
            'image' => 'nullable|required|image|mimes:png,jpg,PNG,jpec',
            'password' => 'required|min:6',
            'email'=> 'required|email|unique:users,email'


        ];
    }
}