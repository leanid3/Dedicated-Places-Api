<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_parent_id' => ['integer', 'nullable'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            "SEO_title" => ['nullable', 'string', 'max:255'],
            "SEO_description" => ['nullable', 'string', 'max:255'],
            "SEO_keywords" => ['nullable', 'string', 'max:255'],
        ];
    }
}
