<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return $this->user()->ableTo('store-user') || $this->user()->isA('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'string|unique:users|max:255', 
            'email' => 'string|unique:users|max:255', 
            'firstName' => 'string|max:255',
            'lastName' => 'string|max:255',
            'password' => 'string|confirmed|min:6|max:255',
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
