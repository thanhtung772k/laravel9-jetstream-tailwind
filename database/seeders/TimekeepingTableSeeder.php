<?php

namespace Database\Seeders;

use App\Models\Timekeeping;
use Illuminate\Database\Seeder;
use App\Traits\HandleDay;

class TimekeepingTableSeeder extends Seeder
{
    use HandleDay;


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDay = strtotime(now()->format('y-m-d 00:00:00'));
        $endDay = strtotime(now()->format('y-m-d 23:59:59'));
        $dateArray = [];
        foreach (range(1, 200) as $date) {
            $hour = rand($startDay, $endDay);
            $dateArray[] = date("Y-m-d H:i:s", $hour);
        }
        function compareDate($date1, $date2)
        {
            return strtotime($date1) - strtotime($date2);
        }
        usort($dateArray, "Database\Seeders\compareDate");

        foreach ($dateArray as $item) {
            Timekeeping::factory()->count(1)->create(['date_time' => $item]);
        }
    }

}
