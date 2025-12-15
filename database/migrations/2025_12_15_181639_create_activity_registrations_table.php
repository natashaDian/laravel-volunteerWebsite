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
        Schema::create('activity_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('activity_id')->constrained()->cascadeOnDelete();

            $table->enum('status', ['pending', 'approved', 'rejected', 'confirmed'])->default('pending');

            $table->string('motivation')->nullable();
            $table->string('phone')->nullable();
            $table->string('confirmation_code')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'activity_id']); // prevent double register
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_registrations');
    }
};
