<?php

namespace Database\Factories;

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
                'title' => $this->faker->sentence(3),
                'author' => $this->faker->name,
                'issued' => $this->faker->date(),
                'cover' => 'covers/'.$this->faker->image('storage/app/public/books', 400, 300, null, false)
        ];
    }
}
