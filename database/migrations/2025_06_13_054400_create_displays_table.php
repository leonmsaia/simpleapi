<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create Displays Table
 *
 * Creates the 'displays' table to store advertising screens linked to users.
 * Each display has basic attributes such as name, description, pricing, resolution,
 * type, and an owner (user_id foreign key).
 */
return new class extends Migration {

    /**
     * Run the migrations.
     *
     * Creates the 'displays' table schema.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('displays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->float('price_per_day');
            $table->integer('resolution_height');
            $table->integer('resolution_width');
            $table->enum('type', ['indoor', 'outdoor']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the 'displays' table.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('displays');
    }
};
