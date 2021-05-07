<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAddRequest extends FormRequest
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
        return [
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'type' => 'nullable',
            'github' => 'nullable|regex:/github.com([\/A-z]*)/',
            'city' => 'nullable',
            'phone' => 'max:11|nullable|regex:/8[0-9]{10}/',
            'birthday' => 'max:4|regex:/[0-9]{4}/|min:4|nullable',
            'post_id' => 'regex:/[0-9]*/|nullable',
        ];
    }
}
