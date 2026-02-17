<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
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
                    'key' => 'required|string|alpha_dash|max:255|unique:settings,key',
                    'value' => 'required|string',
                    'type' => 'nullable|string|max:50',
                    'group' => 'nullable|string|max:100',
                    'description' => 'nullable|string',
                ];
            case 'PUT':
            case 'PATCH':
                $id = $this->route('setting');
                return [
                    'key' => [
                        'required',
                        'string',
                        'alpha_dash',
                        'max:255',
                        Rule::unique('settings', 'key')->ignore($id),
                    ],
                    'value' => 'required|string',
                    'type' => 'nullable|string|max:50',
                    'group' => 'nullable|string|max:100',
                    'description' => 'nullable|string',
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
            'key.required' => 'The setting key is required.',
            'key.unique' => 'A setting with this key already exists.',
            'value.required' => 'The setting value is required.',
        ];
    }
}
