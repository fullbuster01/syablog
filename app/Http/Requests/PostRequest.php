<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            $category = 'required';
            $title = 'required|min:10';
            $content = 'required';
        }else{
            $category = 'required';
            $title = 'required|min:10|unique:posts';
            $content = 'required';
        }
        return [
            'category' => $category,
            'title' => $title,
            'content' => $content,
        ];
    }
}
