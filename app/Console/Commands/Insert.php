<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Models\Timesheet as TimesheetModel;
use App\Services\User\UserService;
use App\Services\Timesheet\TimesheetService;

class Insert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:cron';

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
     * @param UserService $userservice
     * @param TimesheetService $timesheetService
     * @return void
     */
    public function handle(UserService $userservice, TimesheetService $timesheetService)
    {
        $users = $userservice->getAllUser();
        $date = now()->format("Y-m-d");
        if (count($users) > 0) {
            foreach ($users as $user) {
                $timesheetService->createDate($date, $user->id);
            }
        }
    }
}
