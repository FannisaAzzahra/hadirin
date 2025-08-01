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
        Schema::create('presence_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('presence_id');
            $table->string('nama');
            $table->string('nip')->nullable(); // nullable jika Non PLN
            $table->string('email')->nullable(); // nullable jika tidak wajib
            $table->string('jabatan')->nullable();
            $table->string('unit'); // PLN / PLN Group / Non PLN
            $table->string('unit_dtl')->nullable(); // Add this line for Unit Detail
            $table->string('no_hp');
            $table->string('signature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_details');
    }
};
