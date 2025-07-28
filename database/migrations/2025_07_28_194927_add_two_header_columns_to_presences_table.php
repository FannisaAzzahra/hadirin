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
        $table->string('judul_header_atas')->nullable()->after('judul_header');
        $table->string('judul_header_bawah')->nullable()->after('judul_header_atas');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presences', function (Blueprint $table) {
             $table->dropColumn(['judul_header_atas', 'judul_header_bawah']);
        });
    }
};
