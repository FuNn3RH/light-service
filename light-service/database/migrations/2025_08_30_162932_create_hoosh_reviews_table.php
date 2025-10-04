<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hoosh_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('answer_id')->constrained('hoosh_answers')->onDelete('cascade');
            $table->integer('score')->default(10);
            $table->longText('feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoosh_reviews');
    }
};
