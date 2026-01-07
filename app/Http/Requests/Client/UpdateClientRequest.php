<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
        $isPatch = $this->method() == 'PATCH';
        $clientId = $this->route('client');

        return [
            'name' => [
                $isPatch ? 'sometimes' : 'required',
                'string',
                'min:3',
                'max:255',
            ],
            'status' => [
                'sometimes',
                'boolean',
            ],
            'email' => [
                $isPatch ? 'sometimes' : 'required',
                'string',
                'email',
                'min:3',
                'max:255',

                Rule::unique('clients', 'email')->ignore($clientId, 'uuid'),
            ],
            'cpf_cnpj' => [
                $isPatch ? 'sometimes' : 'required',
                'string',
            ],
            'phone' => [
                $isPatch ? 'sometimes' : 'required',
                'string',
            ],
            'address' => [
                $isPatch ? 'sometimes' : 'required',
                'string',
                'min:3',
                'max:255',
            ]
        ];
    }
}
