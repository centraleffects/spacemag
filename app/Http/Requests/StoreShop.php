<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShop extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return auth()->check() && (auth()->user()->isAdmin() or auth()->user()->isOwner());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = ['name' => 'required'];
        if( auth()->user()->isAdmin() ){
            $rules['owner.email'] = 'email';
        }   

        return $rules;
    }
}
