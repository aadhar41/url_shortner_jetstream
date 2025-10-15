<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     * Injects the current authenticated user's ID as the owner_user_id.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'owner_user_id' => Auth::id(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:191|unique:companies,name',
            'email' => 'nullable|email|max:255', // Added email validation
            // This is now set internally, but we validate it to ensure it's a valid user ID.
            'owner_user_id' => ['required', 'exists:users,id'],
        ];
    }
}