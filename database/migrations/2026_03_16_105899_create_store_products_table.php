<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_products', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tutor_id')->constrained('users')->cascadeOnDelete();
    $table->string('title');
    $table->text('description')->nullable();
    $table->integer('price');
    $table->string('file_path');
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('store_products');
    }
};