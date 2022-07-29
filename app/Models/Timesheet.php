<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;


class Timesheet extends Model
{
    use HasFactory;
    use Sortable;

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

    public $sortable  = [
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
        if ($this->attributes['check_in'] === null || $this->attributes['check_out'] === null) {
            $lunchBreak = null;
        } elseif ((config('constant.thirteem_haftpast_PM') - $sumOut) <= config('constant.positive_integer')) {
            $lunchBreak = config('constant.one_haftpast_hour');
        } elseif ((config('constant.thirteem_haftpast_PM') - $sumIn) < config('constant.positive_integer')) {
            $lunchBreak = null;
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
        $sumIn = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($this->attributes['check_in']));
        $sumOut = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($this->attributes['check_out']));
        if (config('constant.twelfth_PM') < $sumOut && $sumOut <= config('constant.thirteem_haftpast_PM')) {
            $sumOut = config('constant.twelfth_PM');
        }
        if (config('constant.seventeen_haftpast_PM') < $sumOut) {
            $sumOut = config('constant.seventeen_haftpast_PM');
        }
        if (!isset($this->attributes['check_out']) || config('constant.eight_AM') - $sumOut >= config('constant.positive_integer') || !isset($this->attributes['check_in'])) {
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
        $sumOut = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($this->attributes['check_out']));
        //check in before 8h
        if ((config('constant.eight_AM') - $sumIn) > config('constant.positive_integer')) {
            $sumIn = config('constant.eight_AM');
        }
        //check in from 12h to 13h30
        if (config('constant.twelfth_PM') <= $sumIn && $sumIn <= config('constant.thirteem_haftpast_PM')) {
            $sumIn = config('constant.thirteem_haftpast_PM');
        }
        if ( !isset($this->attributes['check_out']) || (config('constant.eight_AM') - $sumOut) >= config('constant.positive_integer') || !isset($this->attributes['check_in']) ) {
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
        if ($this->attributes['check_in'] === null || $this->attributes['paid_working_time'] === null) {
            $note = null;
        } elseif ($sum !== config('constant.eight_AM')) {
            $sumNote = config('constant.eight_AM') - $sum;
            $note = __('lang.early') . gmdate("H:i:s", $sumNote);
        } elseif (config('constant.twelfth_PM') - $sumIn <= config('constant.positive_integer')) {
            if (config('constant.thirteem_haftpast_PM') - $sumIn >= config('constant.positive_integer')) {
                $sumIn = config('constant.thirteem_haftpast_PM');
            }
            $sumNote = config('constant.seventeen_haftpast_PM') - $sumIn;
            if ($sumNote == config('constant.four_hour')) {
                $note = null;
            } else {
                $note = __('lang.early') . gmdate("H:i:s", $sumNote);
            }
        } else {
            $note = null;
        }
        return $note;
    }
}

