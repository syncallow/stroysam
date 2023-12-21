<?php

namespace App\Http\Requests\Admin\Tag;

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
            'id' => 'required|integer|exists:tags,id',
            'title' => ['required','string',Rule::unique('tags')->ignore($this->id)],
            'slug' => ['required','string',Rule::unique('tags')->ignore($this->id)],
            'page_ids' => 'nullable|array',
            'page_ids.*' => 'nullable|integer|exists:pages,id'
        ];
    }
}
