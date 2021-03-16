<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
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
        $id = $this->request->get('id');
        return [
            'transferEmail' => 'required',
            'txtAmount' => 'required',
            'txtFee' => 'required',
        ]; 
    }
    
     public function messages()
    {
        return [
            'transferEmail.required' => 'Address  is required.',
             'txtAmount.required' => 'Amount  is required.',
              'txtFee.required' => 'Fee  is required.',

        ];
    }

    
}