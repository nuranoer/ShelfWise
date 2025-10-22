<?php

// app/Models/Author.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Author extends Model {
    use HasFactory;

    protected $fillable = ['name'];
    public function books(): HasMany { return $this->hasMany(Book::class); }
    public function ratings(): HasManyThrough {
        return $this->hasManyThrough(Rating::class, Book::class);
    }
    // helper: hanya rating > 5 (untuk "famous author")
    public function ratingsOver5(): HasManyThrough {
        return $this->ratings()->where('ratings.rating', '>', 5);
    }
}

