<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->string('id')->nullable(false)->unique()->primary();
            $table->string('title')->nullable(false);
            $table->integer('pages_count')->nullable(true);
            $table->string('cover_link')->nullable(true);
            $table->string('summary')->nullable(true);
            $table->string('authors')->nullable(true);
            $table->string('categories')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
