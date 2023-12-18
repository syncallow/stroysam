<?php

namespace App\Http\Requests\Admin\Page;

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
            'id' => 'required|integer|exists:pages,id',
            'filename' => ['required','string',Rule::unique('pages')->ignore($this->id)],
            'slug' => ['required','string',Rule::unique('pages')->ignore($this->id)],
            'title' => 'required|string',
            'content' => 'required|string',
            'fileContent' => 'required|string'
        ];
    }
}
