<?php

// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Author,Category,Book,Rating};

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $authors = collect(['voluptatem','adipiscing','accusantium','reprehenderit','consequuntur','voluptas'])
            ->map(fn($n) => Author::create(['name'=>$n]));

        $cat = collect(['adipiscing','voluptatem','exercitationem','accusantium'])
            ->map(fn($n)=> Category::create(['name'=>$n]));

        // sample books
        $make = fn($name,$a,$c)=> Book::create(['name'=>$name,'author_id'=>$a->id,'category_id'=>$c->id]);
        $b1 = $make('lorem ipsum',      $authors[0], $cat[0]);
        $b2 = $make('dolor sit amet',   $authors[1], $cat[1]);
        $b3 = $make('voluptatem',       $authors[0], $cat[2]);
        $b4 = $make('consequuntur',     $authors[1], $cat[2]);
        $b5 = $make('reprehenderit',    $authors[3], $cat[0]);
        $b6 = $make('accusantium',      $authors[2], $cat[3]);
        $b7 = $make('quia dolor',       $authors[4], $cat[1]);
        $b8 = $make('magnam aliquam',   $authors[1], $cat[0]);
        $b9 = $make('aspernatur minima',$authors[5], $cat[1]);
        $b10= $make('quas molestias',   $authors[0], $cat[0]);
        $b11= $make('ipsum',            $authors[0], $cat[0]);

        // ratings awal
        $seed = [
            [$b1,9],[$b1,8],[$b1,9],
            [$b2,8],[$b2,7],[$b2,6],
            [$b3,6],[$b3,3],[$b3,5],
            [$b4,4],[$b4,5],[$b4,4],
            [$b5,3],[$b5,3],[$b5,3],
            [$b6,9],[$b6,8],
            [$b7,6],[$b7,6],[$b7,7],
            [$b8,7],[$b8,6],
            [$b9,9],
            [$b10,8],[$b10,8],[$b10,9],
        ];
        foreach($seed as [$book,$score]) { Rating::create(['book_id'=>$book->id,'rating'=>$score]); }
    }
}
