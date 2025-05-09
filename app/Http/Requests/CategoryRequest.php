<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        return [
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:255',
                    Rule::unique('categories','name')
                        ->ignore($id)],
                'parent_id' =>
                    ['nullable', 'integer', 'exists:categories,id'],
                'image' =>
                    ['image', 'max:10485760', 'dimensions:min_width=100,min_height=100', 'mimes:jpg,jpeg,png'],
                'status' =>
                    ['required', 'in:active,inactive'],

        ];
    }
}
