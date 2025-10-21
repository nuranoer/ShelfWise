<?php

// database/migrations/2025_01_01_000002_create_books_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('books', function (Blueprint $t) {
            $t->id();
            $t->foreignId('author_id')->constrained()->cascadeOnDelete();
            $t->foreignId('category_id')->constrained()->cascadeOnDelete();
            $t->string('name');
            $t->timestamps();
            $t->unique(['author_id','name']); // 1 author tidak gandakan judul
        });
    }
    public function down(): void { Schema::dropIfExists('books'); }
};
