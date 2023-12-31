<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->sentence(),
            'author' => $this->faker->name(),
            'description' => $this->faker->text(),
            'image' => $this->faker->imageUrl(640, 480),
            'summary' => $this->faker->text(),
            'isbn' => null,
            'slug' => null,
            'read' => false,
        ];
    }
}
