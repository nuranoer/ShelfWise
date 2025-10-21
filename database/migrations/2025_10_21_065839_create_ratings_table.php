<?php

// database/migrations/2025_01_01_000003_create_ratings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ratings', function (Blueprint $t) {
            $t->id();
            $t->foreignId('book_id')->constrained()->cascadeOnDelete();
            $t->unsignedTinyInteger('rating'); // 1..10
            $t->timestamps();
            $t->index(['book_id','rating']);
        });
    }
    public function down(): void { Schema::dropIfExists('ratings'); }
};
