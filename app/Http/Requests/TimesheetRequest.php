<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimesheetRequest extends FormRequest
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
            'evidence_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'reason' => 'required',
            'timesheet_id' => 'unique:add_timesheets,timesheet_id'
        ];
    }
}
