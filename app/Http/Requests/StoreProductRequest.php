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
            'name' => 'required|string|max:255',
            'SKU' => 'required|string|max:255',
            'price' => 'required|integer',
            'weight' => 'required|integer',
            'cartDesc' => 'required|string|max:255',
            'shortDesc' => 'required|string|max:255',
            'longDesc' => 'required|string',
            'thumb' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'stock' => 'required|integer',
            'live' => 'required|boolean',
            'unlimited' => 'required|boolean',
            'category_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',

        ];
    }
}
