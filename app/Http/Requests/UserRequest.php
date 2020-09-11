<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            $name = 'required|min:3';
            $email = 'required|email';
            $type = 'required';
        } else {
            $name = 'required|min:3';
            $email = 'required|email|unique:users';
            $type = 'required';
        }
        
        return [
            'name' => $name,
            'email' => $email,
            'type' => $type,
        ];
    }
}
