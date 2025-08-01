<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->string('display_option_type')->nullable();
        });
    }

    public function down()
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->dropColumn('display_option_type');
        });
    }
};