<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tutor_profiles', function (Blueprint $table) {
            $table->string('title')->nullable(); // e.g., Math Tutor, Web Expert
            $table->text('expertise')->nullable(); // Hum isme comma-separated values save karenge
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tutor_profiles', function (Blueprint $table) {
            //
        });
    }
};
