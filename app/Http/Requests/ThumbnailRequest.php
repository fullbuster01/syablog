<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThumbnailRequest extends FormRequest
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
        $image = 'required|image|mimes:jpg,jpeg,png,|max:5120';
        return [
            'image' => $image
        ];
    }
}
