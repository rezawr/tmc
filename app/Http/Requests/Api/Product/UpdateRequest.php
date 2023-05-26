<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Api\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sku' => 'nullable|string|max:10|min:10|unique:products,sku,'.$this->product->id,
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|integer|min:0',
            'stock' => 'nullable|integer',
            'category_id' => 'nullable|exists:categories,id'
        ];
    }
}
