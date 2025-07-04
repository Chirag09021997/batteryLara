<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductsRequest extends FormRequest
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
            'name'                => ['required', 'string', 'max:255'],
            'is_active'           => ['nullable', 'boolean'],

            'images'              => ['nullable'],
            'images.*'            => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:2048'],

            'removed_images'      => ['nullable', 'string'],

            'warranty_size'       => ['nullable', 'array'],
            'warranty_size.*'     => ['required_with:warranty_coverage,price', 'integer', 'min:1'],

            'warranty_coverage'   => ['nullable', 'array'],
            'warranty_coverage.*' => ['required_with:warranty_size,price', 'in:Day,Month,Year'],

            'price'               => ['nullable', 'array'],
            'price.*'             => ['required_with:warranty_size,warranty_coverage', 'numeric', 'min:0'],

            'existing_warranty_id'       => ['nullable', 'array'],
            'existing_warranty_id.*'     => ['exists:product_warranties,id'],

            'existing_warranty_size'     => ['nullable', 'array'],
            'existing_warranty_size.*'   => ['required_with:existing_warranty_coverage,existing_price', 'integer', 'min:1'],

            'existing_warranty_coverage' => ['nullable', 'array'],
            'existing_warranty_coverage.*' => ['required_with:existing_warranty_size,existing_price', 'in:Day,Month,Year'],

            'existing_price'             => ['nullable', 'array'],
            'existing_price.*'           => ['required_with:existing_warranty_size,existing_warranty_coverage', 'numeric', 'min:0'],
        ];
    }
}
