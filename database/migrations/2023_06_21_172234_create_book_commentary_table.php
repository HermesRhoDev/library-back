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
        Schema::create('book_commentary', function (Blueprint $table) {
            $table->id();
            $table->string('commentary_id')->nullable(false);
            $table->foreign('commentary_id')->references('id')->on('commentaries')->onDelete('cascade');
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
        Schema::drop('book_commentary');
    }
};
