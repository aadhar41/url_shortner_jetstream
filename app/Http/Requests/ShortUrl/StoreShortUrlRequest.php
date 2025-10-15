<?php

namespace App\Http\Requests\ShortUrl;

use Illuminate\Foundation\Http\FormRequest;

class StoreShortUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Assuming authorization is handled in the controller or a policy,
        // we return true here to allow the validation to proceed.
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
            // 'company_id' => ['required', 'exists:companies,id'],
            // Original URL must be a valid URL and not exceed the 2048 character limit
            'original_url' => ['required', 'url', 'max:2048'],
            // 'short_code' => ['nullable', 'string', 'max:20', 'unique:short_urls,short_code'],
        ];
    }
}
