<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('cards', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('text');
        $table->string('image')->nullable();
        $table->enum('layout', ['text-left', 'text-right', 'text-only', 'image-only'])->default('text-left');
        $table->timestamps();
    });
}


public function down()
{
    Schema::dropIfExists('cards');
}

};
