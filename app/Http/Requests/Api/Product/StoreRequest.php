<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sku' => 'required|string|unique:products|max:10|min:10',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
