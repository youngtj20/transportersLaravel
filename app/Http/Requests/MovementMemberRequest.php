<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovementMemberRequest extends FormRequest
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
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'phone_number' => 'required|string|max:20',
                    'email' => 'nullable|email|max:255',
                    'state' => 'required|string|max:255',
                    'lga' => 'required|string|max:255',
                    'ward' => 'required|string|max:255',
                    'unit' => 'required|string|max:255',
                    'modes_of_transport' => 'nullable|array',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'phone_number' => 'required|string|max:20',
                    'email' => 'nullable|email|max:255',
                    'state' => 'required|string|max:255',
                    'lga' => 'required|string|max:255',
                    'ward' => 'required|string|max:255',
                    'unit' => 'required|string|max:255',
                    'modes_of_transport' => 'nullable|array',
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
            'first_name.required' => 'The first name is required.',
            'last_name.required' => 'The last name is required.',
            'phone_number.required' => 'The phone number is required.',
            'state.required' => 'The state is required.',
            'lga.required' => 'The LGA is required.',
            'ward.required' => 'The ward is required.',
            'unit.required' => 'The unit is required.',
        ];
    }
}
