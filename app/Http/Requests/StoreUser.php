<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
        $rules =  [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'address_1' => 'required',
            'zip_code' => 'required|numeric',
            'telephone' => 'required|numeric',
            'mobile' => 'required|numeric',
            'country' => 'required',
        ];

        if( auth()->user()->isAdmin() ){
            $rules['role'] = 'required';
            $rules['email'] = 'required|email|unique:users,id';
        }

        return $rules;
    }

}
