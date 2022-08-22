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
        return [
            'user_id' => 'required|max:255|unique:user_details,employee_code|regex:/(0)[0-9]{2}/',
            'email' => 'required|email|unique:users,email',
            'name' => 'required||max:255|unique:users,name',
            'date_of_birth' => 'required',
            'time_start' => 'required',
            'member_comp' => 'required',
            'location' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'passport' => 'required|integer',
            'evidence_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
