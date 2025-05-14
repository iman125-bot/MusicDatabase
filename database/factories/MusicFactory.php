<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Music>
 */
class MusicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genres = ['Rock', 'Pop', 'Jazz', 'Classical', 'Hip Hop', 'Electronic', 'R&B'];
        $years = range(1960, date('Y')); // Tahun dari 1960 hingga sekarang

        return [
            'title' => $this->faker->words(3, true), // Contoh: "Sweet Child O' Mine"
            'artist' => $this->faker->name, // Contoh: "Guns N' Roses"
            'album' => $this->faker->words(2, true) . ' ' . 
                      $this->faker->randomElement(['Album', 'LP', 'Mixtape']), // Contoh: "Appetite Destruction LP"
            'year' => $this->faker->randomElement($years),
            'genre' => $this->faker->randomElement($genres),
            'duration' => $this->faker->time('i:s'), // Format menit:detik (03:45)
            'created_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'updated_at' => now(),
        ];
    }
}