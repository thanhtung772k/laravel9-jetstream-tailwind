<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['Member', 'Manager', 'COO'];
        foreach ($arr as $key => $value) {
            Position::factory()->count(1)->create(['name' => $value]);
        }
    }
}
