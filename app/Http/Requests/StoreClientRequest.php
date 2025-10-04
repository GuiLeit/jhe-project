<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'cnpj' => 'required|string|max:14|unique:clients,cnpj',
            'observation' => 'nullable|string',
            'contract_value' => 'required|numeric|min:0',
            
            'address' => 'required|array',
            'address.street' => 'required|string|max:255',
            'address.number' => 'required|string|max:20',
            'address.postal_code' => 'required|string|max:20',
            'address.complement' => 'nullable|string|max:255',
            'address.neighborhood' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'cnpj.required' => 'The CNPJ field is required.',
            'cnpj.unique' => 'The CNPJ has already been taken.',
            'contract_value.required' => 'The contract value field is required.',
            'contract_value.numeric' => 'The contract value must be a number.',
            'contract_value.min' => 'The contract value must be at least 0.',

            'address.required' => 'The address field is required.',
            'address.street.required' => 'The street field is required.',
            'address.number.required' => 'The number field is required.',
            'address.postal_code.required' => 'The postal code field is required.',
            'address.neighborhood.required' => 'The neighborhood field is required.',
            'address.city.required' => 'The city field is required.',
        ];
    }
}
