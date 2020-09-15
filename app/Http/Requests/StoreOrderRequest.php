<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return $this->user()->ableTo('store-order') || $this->user()->isA('admin');
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
            'shipping' => 'required|integer',
            'tax' => 'required|integer',
            'details' => 'required|array',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'amount.required' => 'A amount is required',
    //     ];
    // }
}
