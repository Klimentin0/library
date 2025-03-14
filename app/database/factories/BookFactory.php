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
        $dir = storage_path('app/public/books');
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'issued' => $this->faker->date,
            'cover' => $this->faker->image(
                dir: storage_path('app/public/books'),
                width: 400,
                height: 600,
                category: 'nature',
                fullPath: false
            ),
        ];
    }
}
