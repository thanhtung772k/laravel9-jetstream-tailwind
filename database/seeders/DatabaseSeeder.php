<?php

namespace Database\Seeders;

use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TimesheetTableSeeder::class,
            PositionTableSeeder::class,
            RoleTableSeeder::class,
            DepartmentTableSeeder::class,
            ProjectTypeTableSeeder::class,
        ]);
    }
}
