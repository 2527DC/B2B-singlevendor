<?php

namespace Modules\MultiVendor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\MultiVendor\Rules\SellerProfileUpdateRule;

class SellerAccountRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,'.$this->id,
            'shop_display_name' => ['required','max:255'],
            'seller_phone' => 'required|max:100|unique:users,username,'.$this->id,
        ];
    }

    
    public function authorize()
    {
        return true;
    }
}
