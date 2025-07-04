<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'images' => ['nullable'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:2048'],

            'warranty_size' => ['nullable', 'array'],
            'warranty_size.*' => ['required_with:warranty_coverage,price', 'integer', 'min:1'],

            'warranty_coverage' => ['nullable', 'array'],
            'warranty_coverage.*' => ['required_with:warranty_size,price', 'in:Day,Month,Year'],

            'price' => ['nullable', 'array'],
            'price.*' => ['required_with:warranty_size,warranty_coverage', 'numeric', 'min:0'],
        ];
    }
}
