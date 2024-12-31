<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'categoty_id' => ['required', 'integer', 'exists:categoties,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'slug' => ['unique', 'string', 'max:255'],
            'status' => ['nullable', 'string'],
            'stock' =>['nullable', 'integer', 'min:0'],
            'price' => ['nullable', 'integer', 'min:0'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'seo_keyword' => ['nullable', 'string', 'max:255'],
        ];
    }
}
