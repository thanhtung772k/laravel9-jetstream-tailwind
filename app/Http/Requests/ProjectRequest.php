<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
//        dd($this->all());
        return [
            'projectName' => 'required|max:255',
            'valueContract' => 'required|integer|between:1,10',
            'startDateProject' => 'required',
            'endDateProject' => 'required|after:startDateProject',
            'description' => 'required',
            'startDateUser.*' => 'required|after:startDateProject|before:endDateProject',
            'endDateUser.*' => 'required|after:startDateProject|before:endDateProject|after:startDateUser.*',
            'effort.*' => 'required|integer|between:1,100',
            'userID.*' => 'required|distinct',
        ];
    }
}
