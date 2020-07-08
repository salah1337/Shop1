<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:255',
            'SKU' => 'string|max:255',
            'price' => 'integer',
            'weight' => 'integer',
            'cartDesc' => 'string|max:255',
            'shortDesc' => 'string|max:255',
            'longDesc' => 'string',
            'thumb' => 'image',
            // 'image' => 'image',
            'location' => 'string|max:255',
            'stock' => 'integer',
            'live' => 'boolean',
            'unlimited' => 'boolean',
            'product_category_id' => 'integer',
        ];
    }
}
