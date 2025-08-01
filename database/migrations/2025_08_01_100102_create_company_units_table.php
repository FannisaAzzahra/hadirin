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
        Schema::create('company_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nama unit (KANTOR INDUK, UPT SURABAYA, dll)
            $table->text('description')->nullable(); // Deskripsi unit
            $table->boolean('is_active')->default(true); // Status aktif
            $table->integer('sort_order')->default(0); // Urutan tampilan
            $table->timestamps();
            
            // Index untuk performa
            $table->index(['company_id', 'is_active']);
            
            // Unique constraint untuk nama unit per perusahaan
            $table->unique(['company_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_units');
    }
};