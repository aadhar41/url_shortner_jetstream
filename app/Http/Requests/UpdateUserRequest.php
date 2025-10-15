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
        // Assuming user management is restricted to authorized roles (e.g., Admin, SuperAdmin)
        return auth()->check() && in_array(auth()->user()->role, ['Admin', 'SuperAdmin']);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Get the user ID from the route for unique email validation exclusion
        $userId = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId), // Exclude the current user's email
            ],
            // Password is optional for updates. If provided, it must be validated.
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'company_id' => ['required', 'exists:companies,id'],
            'role' => ['required', 'in:Admin,Member'],
        ];
    }
}