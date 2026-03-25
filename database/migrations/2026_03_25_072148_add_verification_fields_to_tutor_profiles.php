<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tutor_profiles', function (Blueprint $table) {
            $table->string('location')->nullable()->after('bio');
            $table->string('degree_certificate')->nullable(); // File path
            $table->string('cv_resume')->nullable(); // File path
        });
    }

    public function down(): void
    {
        Schema::table('tutor_profiles', function (Blueprint $table) {
            $table->dropColumn(['location', 'degree_certificate', 'cv_resume']);
        });
    }
};
