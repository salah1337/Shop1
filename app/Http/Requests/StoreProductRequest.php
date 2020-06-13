<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->ableTo('store-product') || $this->user()->isA('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:products|max:255',
            'SKU' => 'required|string|unique:products|max:255',
            'price' => 'required|integer',
            'weight' => 'required|integer',
            'cartDesc' => 'required|string|max:255',
            'shortDesc' => 'required|string|max:255',
            'longDesc' => 'required|string',
            'thumb' => 'required|string|max:255',
            'image' => 'image',
            'location' => 'required|string|max:255',
            'stock' => 'required|integer',
            'live' => 'required|boolean',
            'unlimited' => 'required|boolean',
            'product_category_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',

        ];
    }
}
