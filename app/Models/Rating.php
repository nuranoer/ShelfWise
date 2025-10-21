<?php

// app/Models/Rating.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model {
    protected $fillable = ['book_id','rating'];
    public function book(): BelongsTo { return $this->belongsTo(Book::class); }
}

