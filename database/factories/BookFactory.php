<?php
namespace Database\Factories;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class BookFactory extends Factory
{
protected $model = Book::class;
public function definition(): array {
return [
'name' => ucfirst($this->faker->unique()->sentence(mt_rand(2,4))),
'author_id' => Author::inRandomOrder()->value('id') ?? 1,
'category_id' => Category::inRandomOrder()->value('id') ?? 1,
'created_at' => $this->faker->dateTimeBetween('-2 years','now'),
'updated_at' => now(),
];
}
}