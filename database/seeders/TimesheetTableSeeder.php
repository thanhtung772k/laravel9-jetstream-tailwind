<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\Post;
use App\Models\Role;
use App\Models\UserDetail;
use Database\Factories\TimesheetFactory;
use Illuminate\Database\Seeder;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TimesheetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(2)->create()->each(function ($user): void {
            $month = now();
            $start = now()->parse($month)->startOfMonth();
            $end = now();
            $dates = [];
            $i = -1;
            // sử dụng cách này có thể lấy được ngày và tháng theo chỉ định. còn nếu tháng hiện tại thì now()->format xong explode()
            while ($start->lte($end)) {
                $i++;
                $dates[] = $start->copy();
                $start->addDay();
                Timesheet::factory()->count(1)->create(['user_id' => $user->id, 'date' => now()->parse($dates[$i])->format("Y-m-d")]);
            }
            UserDetail::factory()->create(['user_id' => $user->id,'employee_code'=>$user->id]);
            Post::factory()->create(['author_id' => $user->id, 'category_id'=>rand(1,2)]);
        });
    }
}
