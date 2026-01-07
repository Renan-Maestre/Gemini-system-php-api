<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class storeClientRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255|min:3',
            'email'    => 'required|string|email|max:255|unique:clients,email',
            'cpf_cnpj' => 'required|string',
            'phone'    => 'required|string',
            'address'  => 'required|string|max:255|min:3',
            'status'   => 'boolean',

        ];
    }
}
