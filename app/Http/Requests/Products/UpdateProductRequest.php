<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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

        return [
            'nome' => [
                $isPatch ? 'sometimes' : 'required',
                'string',
                'min:3',
                'max:255',
            ],
            'preco' =>[
                $isPatch ? 'sometimes' : 'required',
                'numeric',
                'min:1',

            ],
            'categoria_id' => [
                $isPatch ? 'sometimes' : 'required',
                'integer',
            ]
        ];
    }
}
