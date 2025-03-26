<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,category_id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'slug' => ['unique:posts,slug', 'string', 'max:255'],
            'status' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            'params' => ['nullable', 'string'],
            'stock' =>['nullable', 'integer', 'min:0'],
            'price' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'seo_keyword' => ['nullable', 'string', 'max:255'],
            'locale' => ['nullable', 'string', 'max:255'],
            'comment_status' =>['nullable', 'string'],
            'tags.*.id' => ['nullable', 'integer', 'exists:tags,id'],
        ];
    }
    public function messages(): array
    {
        return [
          "category_id.required" => "Category is required.",
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
           'user_id' => Auth::id(),
        ]);
    }
}
