<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\{Author, Category, Book, Rating};


class DatabaseSeeder extends Seeder
{
public function run(): void
{
// Disable event dispatching during mass inserts for speed
Author::unsetEventDispatcher();
Category::unsetEventDispatcher();
Book::unsetEventDispatcher();
Rating::unsetEventDispatcher();


// 1) Authors (1,000)
$this->command->info('Seeding authors...');
Author::factory()->count(1000)->create();


// 2) Categories (3,000)
$this->command->info('Seeding categories...');
Category::factory()->count(3000)->create();


// 3) Books (100,000) in chunks to keep memory in check
$this->command->info('Seeding books...');
$bookTarget = 100000; $chunk = 5000; $made = 0;
while ($made < $bookTarget) {
$size = min($chunk, $bookTarget - $made);
Book::factory()->count($size)->create();
$made += $size;
$this->command->getOutput()->writeln(" > books: {$made}/{$bookTarget}");
}


// Pre-fetch existing book IDs to speed up random selection
$bookIds = Book::query()->pluck('id')->all();
$bookCount = count($bookIds);


// 4) Ratings (500,000) — use raw insert batches for speed
$this->command->info('Seeding ratings...');
$ratingTarget = 500000; $batch = 20000; $made = 0;
$now = now();
while ($made < $ratingTarget) {
$size = min($batch, $ratingTarget - $made);
$rows = [];
for ($i = 0; $i < $size; $i++) {
$rows[] = [
'book_id' => $bookIds[random_int(0, $bookCount-1)],
'rating' => random_int(1,10),
'created_at' => $now,
'updated_at' => $now,
];
}
DB::table('ratings')->insert($rows);
$made += $size;
$this->command->getOutput()->writeln(" > ratings: {$made}/{$ratingTarget}");
}
}
}