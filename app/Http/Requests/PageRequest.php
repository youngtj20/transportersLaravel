<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
        $method = $this->method();
        
        switch($method) {
            case 'POST':
                return [
                    'title' => 'required|string|max:255',
                    'slug' => 'required|string|alpha_dash|max:255|unique:pages,slug',
                    'content' => 'nullable',
                    'meta_title' => 'nullable|string|max:255',
                    'meta_description' => 'nullable|string|max:500',
                    'featured_image' => 'nullable|string',
                    'published' => 'boolean',
                    'page_type' => 'sometimes|string|max:50',
                    'template' => 'sometimes|string|max:50',
                    'slides' => 'nullable|array',
                    'sections' => 'nullable|array',
                ];
            case 'PUT':
            case 'PATCH':
                $id = $this->route('page');
                return [
                    'title' => 'required|string|max:255',
                    'slug' => [
                        'required',
                        'string',
                        'alpha_dash',
                        'max:255',
                        Rule::unique('pages', 'slug')->ignore($id),
                    ],
                    'content' => 'nullable',
                    'meta_title' => 'nullable|string|max:255',
                    'meta_description' => 'nullable|string|max:500',
                    'featured_image' => 'nullable|string',
                    'published' => 'boolean',
                    'page_type' => 'sometimes|string|max:50',
                    'template' => 'sometimes|string|max:50',
                    'slides' => 'nullable|array',
                    'sections' => 'nullable|array',
                ];
            default:
                return [];
        }
    }
    
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The page title is required.',
            'slug.required' => 'The page slug is required.',
            'slug.unique' => 'A page with this slug already exists.',
        ];
    }
}
