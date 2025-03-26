<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
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
            'parent_id' => ['required', 'integer', 'exists:comments,id'],
            'title' => ['required', 'string'],
            'comment' => ['required', 'string'],
            'status' => ['nullable', "string"],
            'user_id'=> ['required', 'integer', 'exists:users,id']
        ];
    }
    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => Auth::id(), 
        ]);
    }
}
