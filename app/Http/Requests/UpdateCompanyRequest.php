<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
        // The unique rule is modified to ignore the current company's ID, which is retrieved from the route.
        // We use $this->route('company') which assumes the route uses a "company" parameter,
        // typical for resourceful controllers.
        $companyId = $this->route('company');

        return [
            'name' => 'sometimes|required|string|max:191|unique:companies,name,' . $companyId,
            'email' => 'nullable|email|max:255', // Added email validation
            // Allows changing the owner if the field is present, but otherwise keeps the existing owner.
            'owner_user_id' => 'nullable|exists:users,id',
        ];
    }
}