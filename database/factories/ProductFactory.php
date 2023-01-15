<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            "name" => $this->faker->name,
            "price" => $this->faker->numberBetween(10000, 60000),
            'category_id' => function (array $post) {
                return Category::inRandomOrder()->first()->id;
            },
            'created_by' => function (array $post) {
                return User::inRandomOrder()->first()->id;
            },
        ];
    }
}
