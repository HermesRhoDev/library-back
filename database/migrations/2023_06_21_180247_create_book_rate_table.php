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
        Schema::create('book_rate', function (Blueprint $table) {
            $table->id();
            $table->string('rate_id')->nullable(false);
            $table->foreign('rate_id')->references('id')->on('rating')->onDelete('cascade');
            $table->string('book_id')->nullable(false);
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_rate');
    }
};
