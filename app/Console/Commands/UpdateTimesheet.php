<?php

namespace App\Console\Commands;

use App\Services\Timekeeping\TimekeepingService;
use App\Services\UserDetail\UserDetailService;
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
     * @param TimekeepingService $timekeepingService
     * @param UserDetailService $userDetailService
     * @return int
     */
    public function handle(UserService $userService, TimesheetService $timesheetService, TimekeepingService $timekeepingService, UserDetailService $userDetailService)
    {
        DB::beginTransaction();
        try {
            $users = $userService->getAllUser();
            foreach ($users as $user) {
                $userDetail = $userDetailService->detail($user->id);
                if (isset($userDetail)) {
                    $code = $userDetail->employee_code;
                    $dateTimekeeping = $timekeepingService->groupBy($code);
                    if (count($dateTimekeeping) > 0) {
                        $min = min($dateTimekeeping);
                        $max = max($dateTimekeeping);
                        $date = now()->format('Y-m-d');
                        $timesheet = $timesheetService->dateTimesheet($date, $user->id);
                        $minTime = now()->parse($min)->format('H:i:s');
                        $maxTime = now()->parse($max)->format('H:i:s');
                        if ($min == $max) {
                            if ($date == now()->parse($min)->format('Y-m-d')) {
                                if (!isset($timesheet->check_in) && !isset($timesheet->check_out)) {
                                    $timesheetService->checkIndateTimesheet($date, $minTime, $timesheet->user_id);
                                } else {
                                    $value = $this->checkTimesheet($minTime, $maxTime, $timesheet->check_in, $timesheet->check_out);
                                    $timesheetService->approval($timesheet->id, $value['Checkin'], $value['Checkout']);
                                }
                            }
                        } else {
                            if ($date == now()->parse($min)->format('Y-m-d')) {
                                $value = $this->checkTimesheet($minTime, $maxTime, $timesheet->check_in, $timesheet->check_out);
                                $timesheetService->approval($timesheet->id, $value['Checkin'], $value['Checkout']);
                            }
                        }
                    }
                    $timekeepingService->updateStatus($code);
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
