<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventGalleryRequest extends FormRequest
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
                    'event_name' => 'required|string|max:255',
                    'event_date' => 'required|date',
                    'description' => 'nullable|string',
                    'images' => 'array',
                    'images.*' => 'string',
                    'published' => 'boolean',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'title' => 'required|string|max:255',
                    'event_name' => 'required|string|max:255',
                    'event_date' => 'required|date',
                    'description' => 'nullable|string',
                    'images' => 'array',
                    'images.*' => 'string',
                    'published' => 'boolean',
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
            'title.required' => 'The event gallery title is required.',
            'event_name.required' => 'The event name is required.',
            'event_date.required' => 'The event date is required.',
            'images.required' => 'The images array is required.',
        ];
    }
}
