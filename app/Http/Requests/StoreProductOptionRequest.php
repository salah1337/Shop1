<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductOptionRequest extends FormRequest
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
            'priceIncrement' => 'required|integer',
            'option_id' => 'required|string|max:255',
            'option_group_id' => 'required|string|max:255',
            'product_id' => 'required|string|max:255',
        ];
    }
}
