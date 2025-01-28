<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5'],
            'email' => ['required', 'unique:employees,email', 'email'],
            'password' => ['required', 'min:8'],
            'position_id' => ['required', 'integer', 'exists:positions,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :attribute не должно быть пустым',
            'min' => [
                'numeric' => ':attribute должен быть минимум :min символов.',
                'string' => 'Поле :attribute должно :min символов.'
            ],
            'confirmed' => ':attribute не совпадает',
            'unique' => ':attribute уже используется'

        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Имя',
            'email' => 'Почта',
            'password' => 'Пароль'
        ];
    }
}
