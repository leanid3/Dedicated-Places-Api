<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePostRequest extends FormRequest
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
            'category_id' => ['nullable', 'integer', 'exists:categories,category_id'],
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'slug' => ['unique:posts,slug', 'string', 'max:255'],
            'status' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            'params' => ['nullable', 'string'],
            'stock' =>['nullable', 'integer', 'min:0'],
            'price' => ['nullable', 'integer', 'min:0'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'seo_keyword' => ['nullable', 'string', 'max:255'],
            'locale' => ['nullable', 'string', 'max:255'],
            'comment_status' =>['nullable', 'string'],
            'tags.*.id' => ['nullable', 'integer', 'exists:tags,id'],
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge(['user_id' => Auth::id()]);
    }
}
