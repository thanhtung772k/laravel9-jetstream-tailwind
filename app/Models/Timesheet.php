<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Timesheet extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'timesheets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'check_in',
        'check_out',
        'actual_working_time',
        'paid_working_time',
        'note',
        'user_id'
    ];

    /**
     * Get the timesheet's luch break time.
     *
     * @return string
     */
    public function getLunchBreakTimeAttribute()
    {
        $sumIn = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($this->attributes['check_in']));
        $sumOut = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($this->attributes['check_out']));
        if ((config('constant.thirteem_haftpast_PM') - $sumOut) <= 0 && (config('constant.twelfth_PM') - $sumIn) >= 0) {
            $lunchBreak = config('constant.one_haftpast_hour');
        } else {
            $lunchBreak = null;
        }
        return $lunchBreak;
    }

    /**
     * Get the timesheet's luch break time.
     *
     * @return string
     */
    public function getCheckoutPayAttribute()
    {
        $sumOut = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($this->attributes['check_out']));
        if (config('constant.twelfth_PM') < $sumOut && $sumOut <= config('constant.thirteem_haftpast_PM')) {
            $sumOut = config('constant.twelfth_PM');
        }
        if (config('constant.seventeen_haftpast_PM') < $sumOut) {
            $sumOut = config('constant.seventeen_haftpast_PM');
        }
        if ($this->attributes['check_out'] === null) {
            $sumOut = null;
        }
        return $sumOut;
    }

    /**
     * Get attribute the timesheet's checkin.
     *
     * @return string
     */
    public function getCheckinPayAttribute()
    {
        $sumIn = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($this->attributes['check_in']));
        //check in before 8h
        if ((config('constant.eight_AM') - $sumIn) > 0) {
            $sumIn = config('constant.eight_AM');
        }
        //check in from 12h to 13h30
        if (config('constant.twelfth_PM') <= $sumIn && $sumIn <= config('constant.thirteem_haftpast_PM')) {
            $sumIn = config('constant.thirteem_haftpast_PM');
        }
        if ($this->attributes['check_out'] === null) {
            $sumIn = null;
        }
        return $sumIn;
    }

    /**
     * Get attribute the timesheet's checkin.
     *
     * @return string
     */
    public function getNoteCheckAttribute()
    {
        $sumIn = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($this->attributes['check_in']));
        $sum = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($this->attributes['paid_working_time']));
        if ($sum !== config('constant.eight_AM')) {
            $sumNote = config('constant.eight_AM') - $sum;
            $note = __('lang.early') . gmdate("H:i:s", $sumNote);
        } elseif (config('constant.twelfth_PM') - $sumIn <= 0) {
            if (config('constant.thirteem_haftpast_PM') - $sumIn >= 0) {
                $sumIn = config('constant.thirteem_haftpast_PM');
            }
            $sumNote = config('constant.seventeen_haftpast_PM') - $sumIn;
            if ($sumNote == config('constant.four_hour')) {
                $note = null;
            } else {
                $note = __('lang.early'). gmdate("H:i:s", $sumNote);
            }
        } else {
            $note = null;
        }
        return $note;
    }
}

