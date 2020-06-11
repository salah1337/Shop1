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
            'shipName' => 'required|string|max:255',
            'shipAddress' => 'required|string|max:255',
            'shipAddress2' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|integer',
            'country' => 'required|string|max:255',
            'phone' => 'required|integer',
            'fax' => 'required|integer',
            'shipping' => 'required|integer',
            'tax' => 'required|integer',
            'email' => 'required|string|max:255',
            'shipped' => 'required|boolean',
            'details' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'A amount is required',
        ];
    }
}
