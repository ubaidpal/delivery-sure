<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddAccount extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'full_name'                 => 'required|max:50',
            'permanent_billing_address' => 'required',
            //'temp_billing_address'      => 'required',
            //'temp_billing_address_2'    => 'required',
            'city'                      => 'required',
            'state'                     => 'required|max:4',
            'post_code'                 => 'required',
            'country'                   => 'required',
            'account_number'            => 'required',
            'iban_number'               => 'required|max:34',
            'swift_code'                => 'required',
            'bank_name'                 => 'required',
            'bank_branch_city'          => 'required',
            'branch_country'            => 'required',
        ];
    }
}
