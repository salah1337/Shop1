<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->ableTo('store-user') || $this->user()->isA('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|unique:users|max:255', 
            'email' => 'required|string|unique:users|max:255', 
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:6|max:255',
            'title' => 'string|max:255',
            'gender' => 'string|max:255',
            'city' => 'string|max:255',
            'state' => 'string|max:255',
            'zip' => 'integer',
            'phone' => 'integer',
            'fax' => 'integer',
            'country' => 'string|max:255',
            'adress' => 'string|max:255',
            'adress2' => 'string|max:255',
        ];
    }
}
