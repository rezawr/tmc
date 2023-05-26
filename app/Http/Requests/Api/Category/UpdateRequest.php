<?php
namespace App\Http\Requests\Api\Category;

// use Illuminate\Foundation\Http\FormRequest;
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
            'name' => 'nullable|string|max:255'
        ];
    }
}
