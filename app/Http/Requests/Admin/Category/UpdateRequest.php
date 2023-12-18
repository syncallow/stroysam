<?php

namespace App\Http\Requests\Admin\Category;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        return [
            'id' => 'required|integer|exists:categories,id',
            'title' => 'required|string',
            'slug' => ['required','string',Rule::unique('categories')->ignore($this->id)],
            'parent_id' => 'nullable|integer|exists:categories,id',
        ];
    }
}
