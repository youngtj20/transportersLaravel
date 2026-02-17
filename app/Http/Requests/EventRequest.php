<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
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
                    'slug' => 'required|string|alpha_dash|max:255|unique:events,slug',
                    'description' => 'nullable',
                    'event_date' => 'required|date',
                    'location' => 'nullable|string|max:255',
                    'featured_image' => 'nullable|string',
                    'published' => 'boolean',
                    'speakers' => 'nullable|array',
                    'agenda' => 'nullable|array',
                ];
            case 'PUT':
            case 'PATCH':
                $id = $this->route('event');
                return [
                    'title' => 'required|string|max:255',
                    'slug' => [
                        'required',
                        'string',
                        'alpha_dash',
                        'max:255',
                        Rule::unique('events', 'slug')->ignore($id),
                    ],
                    'description' => 'nullable',
                    'event_date' => 'required|date',
                    'location' => 'nullable|string|max:255',
                    'featured_image' => 'nullable|string',
                    'published' => 'boolean',
                    'speakers' => 'nullable|array',
                    'agenda' => 'nullable|array',
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
            'title.required' => 'The event title is required.',
            'slug.required' => 'The event slug is required.',
            'slug.unique' => 'An event with this slug already exists.',
            'event_date.required' => 'The event date is required.',
        ];
    }
}
