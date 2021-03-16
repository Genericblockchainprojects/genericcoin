<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'email' => 'required|email',
        ]; 
    }
    
     public function messages()
    {
        return [
            'email.required' => 'Email  is required.',
            'email.email' => 'Invalid email address.',

        ];
    }

    
}