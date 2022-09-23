<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['Business', 'World', 'Design', 'Lifestyle'];
        foreach ($arr as $key => $value) {
            Category::factory()->count(1)->create(['name' => $value, 'slug' => Str::slug($value)]);
        }
    }
}
