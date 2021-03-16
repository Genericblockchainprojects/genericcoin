<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'current_password' => 'required|min:6|max:12',
            'new_password' => 'required||min:6|max:12',
            'confirm_password' => 'required|same:new_password'
        ]; 
    }
    
     public function messages()
    {
        return [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'confirm_password.required' => 'Confirm password is required.',
            'confirm_password.same' => 'Confirm pasword not matched with new password.'
        ];
    }

    
}