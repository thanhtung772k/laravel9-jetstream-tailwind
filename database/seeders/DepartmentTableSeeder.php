<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['D1', 'D2' , 'QA1', 'QA2'];
        foreach ($arr as $key => $value) {
            Department::factory()->count(1)->create(['name' => $value]);
        }
    }
}
