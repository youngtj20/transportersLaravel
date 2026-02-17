<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
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
                    'url' => 'required|string|max:255',
                    'parent_id' => 'nullable|integer|exists:menu_items,id',
                    'order' => 'nullable|integer|min:0',
                    'type' => 'nullable|string|max:50',
                    'icon' => 'nullable|string|max:100',
                    'target' => 'nullable|string|max:10',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'title' => 'required|string|max:255',
                    'url' => 'required|string|max:255',
                    'parent_id' => 'nullable|integer|exists:menu_items,id',
                    'order' => 'nullable|integer|min:0',
                    'type' => 'nullable|string|max:50',
                    'icon' => 'nullable|string|max:100',
                    'target' => 'nullable|string|max:10',
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
            'title.required' => 'The menu item title is required.',
            'url.required' => 'The menu item URL is required.',
        ];
    }
}
