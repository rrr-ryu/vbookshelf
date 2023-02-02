<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

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
    protected $model = Book::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->sentence(),
            'url' => $this->faker->url(),
            'type_id' => 2,
            'site_name_id' => $this->faker->numberBetween(2,6),
            'genre_id' => $this->faker->numberBetween(2,9),
            'finish' => $this->faker->numberBetween(0,1),
            'read_page' => $this->faker->numberBetween(0,99),
            'all_page' => $this->faker->numberBetween(99,1000),
            'assessment' => $this->faker->numberBetween(1,5),
            'book_color_id' => $this->faker->numberBetween(1,7),
        ];
    }
}
