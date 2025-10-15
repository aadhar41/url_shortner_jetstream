<?php

namespace App\Http\Requests\ShortUrl;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShortUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Assuming authorization is handled in the controller or a policy
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
            'company_id' => ['required', 'exists:companies,id'],
            'original_url' => ['required', 'url', 'max:2048'],
            'is_active' => ['required', 'boolean'],
            // Note: short_code is typically not changeable after creation
        ];
    }
}