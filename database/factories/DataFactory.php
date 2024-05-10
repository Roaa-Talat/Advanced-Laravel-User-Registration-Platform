<?php

namespace Database\Factories;

use App\Models\Data;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Data::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'user_name' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // You might want to generate a hashed password here
            'birthdate' => $this->faker->date,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'user_image' => $this->faker->imageUrl(), // You might want to use a placeholder image here
        ];
    }
}
