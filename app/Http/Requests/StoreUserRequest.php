<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Assuming user management is restricted to authorized roles (e.g., Admin, SuperAdmin)
        return auth()->check() && in_array(auth()->user()->role, ['Admin', 'SuperAdmin']);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' looks for 'password_confirmation' field
            'company_id' => ['required', 'exists:companies,id'],
            'role' => ['required', 'in:Admin,Member'], // Restricting roles that can be assigned
        ];
    }
}