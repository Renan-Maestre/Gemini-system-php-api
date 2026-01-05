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
            'name' => [
                $isPatch ? 'sometimes' : 'required',
                'string',
                'min:3',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'price' => [
                $isPatch ? 'sometimes' : 'required',
                'numeric',
                'min:0.01',
            ],
            'quantity' => [
                $isPatch ? 'sometimes' : 'required',
                'integer',
                'min:0',
            ],
            'category_id' => [
                $isPatch ? 'sometimes' : 'required',
                'exists:categories,uuid',
            ],
            'status' => [
                'sometimes',
                'boolean',
            ],
            'image' => [
                'nullable',
                'string',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],
        ];
    }
}
