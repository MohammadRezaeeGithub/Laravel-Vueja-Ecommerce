<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence(),
            'slug' => $this->faker->slug(),
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->realText(2000),
            'price' => $this->faker->numberBetween(20,100),
            'created_at'=> now(),
            'updated_at'=>now(),
            'created_by'=> 1,
            'updated_by'=>1

        ];
    }
}
