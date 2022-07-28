<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrCheckIn = ['Developer', 'Tester'];
        $checkIn = $arrCheckIn[rand(0, 1)];
            return [
                'name' => $checkIn,
            ];
    }
}
