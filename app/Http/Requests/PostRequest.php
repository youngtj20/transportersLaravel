<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
                    'slug' => 'required|string|alpha_dash|max:255|unique:posts,slug',
                    'content' => 'nullable',
                    'excerpt' => 'nullable|string|max:500',
                    'featured_image' => 'nullable|string',
                    'published' => 'boolean',
                    'category' => 'nullable|string|max:100',
                    'tags' => 'nullable|array',
                    'gallery_images' => 'nullable|array',
                ];
            case 'PUT':
            case 'PATCH':
                $id = $this->route('post');
                return [
                    'title' => 'required|string|max:255',
                    'slug' => [
                        'required',
                        'string',
                        'alpha_dash',
                        'max:255',
                        Rule::unique('posts', 'slug')->ignore($id),
                    ],
                    'content' => 'nullable',
                    'excerpt' => 'nullable|string|max:500',
                    'featured_image' => 'nullable|string',
                    'published' => 'boolean',
                    'category' => 'nullable|string|max:100',
                    'tags' => 'nullable|array',
                    'gallery_images' => 'nullable|array',
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
            'title.required' => 'The post title is required.',
            'slug.required' => 'The post slug is required.',
            'slug.unique' => 'A post with this slug already exists.',
        ];
    }
}
