<?php

namespace Database\Factories;

use App\Models\Timekeeping;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserDetail;


class TimekeepingFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Timekeeping::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = UserDetail::pluck('employee_code');
        return [
            'employee_code' => $this->faker->randomElement($users),
            'date_time' => $this->faker->date(),
        ];
    }
}
