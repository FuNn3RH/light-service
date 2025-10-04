<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('rust_treasures', function (Blueprint $table) {
            $table->id();
            $table->string('code_quest');
            $table->string('title');
            $table->longText('story');
            $table->text('previous_loot');
            $table->text('img')->nullable();
            $table->text('location');
            $table->string('last_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('rust_treasures');
    }
};
