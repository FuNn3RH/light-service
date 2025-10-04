<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('power_schedules_push_subscription', function (Blueprint $table) {
            $table->id();
            $table->text('endpoint');
            $table->string('keys_auth');
            $table->string('keys_p256dh');
            $table->text('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('power_schedules_push_subscription');
    }
};
