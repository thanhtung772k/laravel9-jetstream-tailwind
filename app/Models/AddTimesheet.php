<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddTimesheet extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'add_timesheets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'timesheet_id',
        'user_id',
        'check_in_real',
        'check_out_real',
        'check_int_request',
        'check_out_request',
        'evidence',
        'description'
    ];

    /**
     * Get additional timesheet's confirm information.
     * @return string
     */
    public function getConfirmInfoAttribute()
    {
        if ($this->attributes['status'] == config('constant.status_wait')) {
            $confirmInfo = __('lang.pending');
        } elseif ($this->attributes['status'] == config('constant.status_agree')) {
            $confirmInfo = __('lang.agree');
        } else {
            $confirmInfo = __('lang.refuse');
        }
        return $confirmInfo;
    }
}
