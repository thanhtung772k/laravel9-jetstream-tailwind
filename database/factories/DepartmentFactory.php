<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrCheckIn = ['D1', 'D2'];
        $checkIn = $arrCheckIn[rand(0, 1)];
        return [
            'name' => $checkIn,
        ];
    }
}
