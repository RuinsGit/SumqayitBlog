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
        Schema::table('digitals', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->string('image_az')->nullable();
            $table->string('image_en')->nullable();
            $table->string('image_ru')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('digitals', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->dropColumn('image_az');
            $table->dropColumn('image_en');
            $table->dropColumn('image_ru');
        });
    }
};
