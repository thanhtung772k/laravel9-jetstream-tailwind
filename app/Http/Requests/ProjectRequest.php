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
            'project_name' => 'required|max:255',
            'value_contract' => 'required|integer|between:1,1000',
            'start_date_project' => 'required',
            'end_date_project' => 'required|after:start_date_project',
            'description' => 'required',
            'start_date_user.*' => 'required|after_or_equal:start_date_project|before:end_date_project',
            'end_date_user.*' => 'required|after:start_date_project|before_or_equal:end_date_project|after_or_equal:start_date_user.*',
            'effort.*' => 'required|integer|between:1,100',
            'user_id.*' => 'required|distinct',
        ];
    }
}
