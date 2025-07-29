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
        Schema::create('attendance_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // Kode unik 10 karakter
            $table->foreignId('presence_id')->constrained('presences')->onDelete('cascade');
            $table->string('nama')->nullable(); // Nama peserta (opsional, bisa diisi saat absen)
            $table->string('email')->nullable(); // Email peserta (opsional)
            $table->string('nip')->nullable(); // NIP peserta (opsional)
            $table->boolean('is_used')->default(false); // Status penggunaan
            $table->timestamp('used_at')->nullable(); // Waktu penggunaan
            $table->timestamp('expires_at')->nullable(); // Waktu kadaluarsa (opsional)
            $table->timestamps();
            
            // Index untuk performa
            $table->index(['code', 'presence_id']);
            $table->index(['is_used', 'presence_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_codes');
    }
};
