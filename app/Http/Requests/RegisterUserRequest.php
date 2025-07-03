<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:10', 'min:4', Rule::unique('users', 'name')],
            'phone' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'max:16', 'min:8'],
            'address' => 'nullable',
            'role' => ['required', Rule::in(['student', 'guardian'])],
            'institution' => 'required_if:role,student',
            'share_location' => 'boolean',
            'auto_alert_on_missed_calls' => 'boolean',
            'relationship' => 'required_if:role,guardian',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
}
