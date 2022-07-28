<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrCheckIn = ['Lapo', 'Spot'];
        $checkIn = $arrCheckIn[rand(0, 1)];
        return [
            'name' => $checkIn,
        ];
    }
}
