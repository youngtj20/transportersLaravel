<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamMemberRequest extends FormRequest
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
                    'name' => 'required|string|max:255',
                    'position' => 'required|string|max:255',
                    'bio' => 'nullable|string',
                    'image' => 'nullable|string',
                    'facebook' => 'nullable|url',
                    'twitter' => 'nullable|url',
                    'instagram' => 'nullable|url',
                    'linkedin' => 'nullable|url',
                    'published' => 'boolean',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|string|max:255',
                    'position' => 'required|string|max:255',
                    'bio' => 'nullable|string',
                    'image' => 'nullable|string',
                    'facebook' => 'nullable|url',
                    'twitter' => 'nullable|url',
                    'instagram' => 'nullable|url',
                    'linkedin' => 'nullable|url',
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
            'name.required' => 'The team member name is required.',
            'position.required' => 'The team member position is required.',
        ];
    }
}
