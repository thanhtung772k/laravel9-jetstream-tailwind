<?php

namespace App\Console\Commands;

use App\Services\Timekeeping\TimekeepingService;
use Illuminate\Console\Command;
use App\Services\User\UserService;
use App\Services\Timesheet\TimesheetService;
use App\Traits\HandleDay;
use Illuminate\Support\Facades\DB;

class UpdateTimesheet extends Command
{
    use HandleDay;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param UserService $userService
     * @param TimesheetService $timesheetService
     * @return int
     */
    public function handle(UserService $userService, TimesheetService $timesheetService, TimekeepingService $timekeepingService)
    {
        DB::beginTransaction();
        try {
            $timekeepings = $timekeepingService->groupBy();
            $maxAndMins = ['max', 'min'];
            //Group by employee_code for status = 0
            foreach ($maxAndMins as $maxAndMin) {
                foreach ($timekeepings as $key => $timekeeping) {
                    $maxAndMinSums[$key][$maxAndMin] = $timekeepingService->maxOrMin($key, $maxAndMin);
                }
            }
            foreach ($maxAndMinSums as $key => $maxAndMinSum) {
                $date = now()->parse($maxAndMinSum['min'])->format('Y-m-d');
                //Min timesheet
                $minValue = now()->parse($maxAndMinSum['min'])->format('H:i:s');
                $minValueToSec = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($minValue));
                //Max timesheet
                $maxValue = now()->parse($maxAndMinSum['max'])->format('H:i:s');
                $maxValueToSec = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($maxValue));
                //only 1 data => min=max
                if ($minValueToSec == $maxValueToSec) {
                    $minMaxValueToSec = $minValueToSec;
                }
                foreach ($userService->index($date, $key) as $value) {
                    //Update status = 1
                    $timekeepingService->updateStatus($key);
                    //get data timesheet by id and userID
                    $timesheetById = $timesheetService->timesheetById($value->time_id, $value->user_id);
                    // Min = Max (only 1 data)
                    if (isset($minMaxValueToSec)) {
                        //checkIn = null
                        if (!isset($timesheetById->check_in)) {
                            //Checkout = null
                            if (!isset($timesheetById->check_out)) {
                                $timesheetService->checkinDateTimesheet($date, $minValue, $timesheetById->user_id);
                            } else {
                                $checkoutToSec = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($timesheetById->check_out));
                                if ($minMaxValueToSec > $checkoutToSec) {
                                    $timesheets = $timesheetService->getTimesheet($value->user_id);
                                    $timesheetService->checkoutDateTimesheet($timesheets, $date, $minValue, $timesheetById->user_id);
                                } else {
                                    $timesheetService->approval($timesheetById->id, $minValue, $timesheetById->check_out);
                                }
                            }
                            //checkin != null
                        } else {
                            $checkinToSec = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($timesheetById->check_in));
                            if (!isset($timesheetById->check_out)) {
                                //checkout = null
                                if ($minMaxValueToSec < $checkinToSec) {
                                    $timesheetService->approval($timesheetById->id, $minValue, $timesheetById->check_in);
                                } else {
                                    $timesheetService->approval($timesheetById->id, $timesheetById->check_in, $minValue);
                                }
                            } else {
                                $checkoutToSec = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($timesheetById->check_out));
                                //MinMax < checkIn < checkout
                                if ($minMaxValueToSec < $checkinToSec) {
                                    $timesheetService->approval($timesheetById->id, $minValue, $timesheetById->check_out);
                                    // checkIn < checkout < MinMax
                                } else if ($minMaxValueToSec > $checkoutToSec) {
                                    $timesheetService->approval($timesheetById->id, $timesheetById->check_in, $minValue);
                                    //checkIn < MinMax < checkout
                                } else {
                                    $timesheetService->approval($timesheetById->id, $timesheetById->check_in, $timesheetById->check_out);
                                }
                            }
                        }
                        //Min != Max (2 or more data )
                    } else {
                        //Checkout = null
                        if (!isset($timesheetById->check_in)) {
                            if (!isset($timesheetById->check_out)) {
                                $timesheetService->approval($timesheetById->id, $minValue, $maxValue);
                            } else {
                                $checkoutToSec = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($timesheetById->check_out));
                                if ($maxValueToSec > $checkoutToSec) {
                                    $timesheetService->approval($timesheetById->id, $minValue, $maxValue);
                                } else {
                                    $timesheetService->approval($timesheetById->id, $minValue, $timesheetById->check_out);
                                }
                            }
                        } else {
                            $checkinToSec = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($timesheetById->check_in));
                            if (!isset($timesheetById->check_out)) {
                                if ($minValueToSec < $checkinToSec) {
                                    $timesheetService->approval($timesheetById->id, $minValue, $maxValue);
                                } else {
                                    $timesheetService->approval($timesheetById->id, $timesheetById->check_in, $maxValue);
                                }
                            } else {
                                $checkoutToSec = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($timesheetById->check_out));
                                if ($minValueToSec < $checkinToSec) {
                                    if ($maxValueToSec > $checkoutToSec) {
                                        $timesheetService->approval($timesheetById->id, $minValue, $maxValue);
                                    } else {
                                        $timesheetService->approval($timesheetById->id, $minValue, $timesheetById->check_out);
                                    }
                                } else {
                                    if ($maxValueToSec > $checkoutToSec) {
                                        $timesheetService->approval($timesheetById->id, $timesheetById->check_in, $maxValue);
                                    } else {
                                        $timesheetService->approval($timesheetById->id, $timesheetById->check_in, $timesheetById->check_out);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }
}
