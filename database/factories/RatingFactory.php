<?php
namespace Database\Factories;
use App\Models\Rating;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{

protected $model = Rating::class;
public function definition(): array {
return [
'book_id' => Book::inRandomOrder()->value('id') ?? 1,
'rating' => $this->faker->numberBetween(1,10),
'created_at' => $this->faker->dateTimeBetween('-2 years','now'),
'updated_at' => now(),
];
}
}