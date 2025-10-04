<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('hoosh_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_question_id')->constrained('hoosh_main_questions')->onDelete('cascade');
            $table->longText('content');
            $table->text('image')->nullable();
            $table->integer('score')->default(10);
            $table->string('type')->default('text');
            $table->boolean('showType')->default(0)->comment('0 => dont show with main , 1 => show with main');
            $table->text('options')->nullable();
            $table->string('level')->default('آسان');
            $table->string('category')->default('بدون دسته بندی');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('hoosh_questions');
    }
};
