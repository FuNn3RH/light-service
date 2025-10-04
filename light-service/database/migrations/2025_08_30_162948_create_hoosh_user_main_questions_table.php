<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('hoosh_user_main_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('hoosh_users')->onDelete('cascade');
            $table->foreignId('main_question_id')->constrained('hoosh_main_questions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('hoosh_user_main_questions');
    }
};
