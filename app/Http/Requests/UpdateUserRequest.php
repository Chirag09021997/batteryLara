<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $decodedId = base64_decode($this->route('installer'));
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($decodedId)],
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:Admin,Installer',
            'mobile_no' => 'nullable|string|max:15',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
