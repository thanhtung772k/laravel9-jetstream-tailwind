<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserDetail;

class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_id' => $this->faker->uuid(),
            'date_of_birth' => $this->faker->date(),
            'time_start' => now(),
            'member_company' => $this->faker->company(),
            'position_id' => rand(1,2),
            'departments_id' => rand(1,2),
            'role_id' => rand(1,2),
            'phone' => $this->faker->e164PhoneNumber(),
            'passport' => $this->faker->creditCardNumber(),
        ];
    }
}
