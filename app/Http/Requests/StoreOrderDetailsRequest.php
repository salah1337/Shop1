<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderDetailsRequest extends FormRequest
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
            'quantity' => 'required|integer',
            'product_id' => 'required|string|max:255',
            'order_id' => 'required|string|max:255',
        ];
    }
}
