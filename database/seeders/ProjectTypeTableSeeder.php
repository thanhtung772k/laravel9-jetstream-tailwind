<?php

namespace Database\Seeders;

use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class ProjectTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['lapo', 'Spot'];
        foreach ($arr as $key => $value) {
            ProjectType::factory()->count(1)->create(['name' => $value]);
        }
    }
}
