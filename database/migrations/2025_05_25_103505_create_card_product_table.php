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
        Schema::create('card_product', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('text');
    $table->string('image')->nullable();
    $table->enum('layout', ['text-left', 'text-right', 'text-only', 'image-only'])->default('text-left');
    $table->enum('text_align', ['left', 'center', 'right', 'justify'])->default('left');
    $table->enum('fit_mode', ['cover', 'contain', 'original'])->default('cover');
    $table->integer('position')->default(0);
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_product');
    }
};
