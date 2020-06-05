<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->ableTo('store-order') || $this->user()->isA('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required|integer',
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
            'trackingNumber' => 'required|integer',
        ];
    }
}
