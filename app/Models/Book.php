<?php

// app/Models/Book.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model {
    protected $fillable = ['name','author_id','category_id'];
    public function author(): BelongsTo { return $this->belongsTo(Author::class); }
    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function ratings(): HasMany { return $this->hasMany(Rating::class); }
}
