<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('rust_treasure_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('rust_users')->onDelete('cascade');
            $table->foreignId('treasure_id')->nullable()->constrained('rust_treasures')->onDelete('cascade');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('rust_treasure_logs');
    }
};
