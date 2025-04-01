<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('digitals', function (Blueprint $table) {
            $table->dropColumn('file');
            $table->string('file_az')->nullable();
            $table->string('file_en')->nullable();
            $table->string('file_ru')->nullable();
        });
    }

    public function down()
    {
        Schema::table('digitals', function (Blueprint $table) {
            $table->string('file')->nullable();
            $table->dropColumn(['file_az', 'file_en', 'file_ru']);
        });
    }
}; 