<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Di dalam file database/migrations/xxxx_xx_xx_create_activities_table.php
public function up()
{
    Schema::create('activities', function (Blueprint $table) {
        $table->id();
        $table->string('activity_id')->unique();
        $table->string('title');
        $table->text('description');
        $table->string('image_url');
        $table->date('start_date');
        $table->date('end_date');
        $table->string('category');
        $table->integer('quota');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
