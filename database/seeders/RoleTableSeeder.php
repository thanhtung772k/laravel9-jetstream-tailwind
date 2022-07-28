<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['Developer', 'Tester'];
        foreach ($arr as $key => $value) {
            Role::factory()->count(1)->create(['name' => $value]);
        }
    }
}
