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
        Schema::table('presences', function (Blueprint $table) {
            $table->string('judul_header')->nullable();
            $table->string('logo_kiri')->nullable();
            $table->string('logo_kanan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->dropColumn(['judul_header', 'logo_kiri', 'logo_kanan']);
        });
    }
};
