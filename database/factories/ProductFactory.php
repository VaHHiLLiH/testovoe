<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetName(),
            'slug' => '',
            'image' => $this->faker->imageUrl(300, 220),
            'description' => $this->faker->text(150),
            'price' => 0.0,
            'old_price' => null,
            'brand' => $this->faker->word,

        ];
    }
}
