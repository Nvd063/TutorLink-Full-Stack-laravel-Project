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
            // nullOnDelete() ya nullable() zaroori hai taake ye optional rahay
            $table->string('profile_image')->nullable()->after('bio');
        });
    }

    public function down(): void
    {
        Schema::table('tutor_profiles', function (Blueprint $table) {
            $table->dropColumn('profile_image');
        });
    }
};
