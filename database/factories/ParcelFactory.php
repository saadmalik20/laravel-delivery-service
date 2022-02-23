<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParcelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender_id' => rand(1,5),
            'biker_id' => null,
            'pickup_address' => $this->faker->city(),
            'delivery_address' => $this->faker->city(),
            'status' => 0,
        ];
    }
}
