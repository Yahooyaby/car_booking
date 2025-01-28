<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeLoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required','email', 'string'],
            'password' => ['required',]
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :attribute не должно быть пустым',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Почта',
            'password' => 'Пароль'
        ];
    }
}
