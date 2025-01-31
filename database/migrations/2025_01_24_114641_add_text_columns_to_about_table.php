<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTextColumnsToAboutTable extends Migration
{
    public function up()
    {
        Schema::table('about', function (Blueprint $table) {
            $table->text('text_az')->nullable()->after('description_ru');
            $table->text('text_en')->nullable()->after('text_az');
            $table->text('text_ru')->nullable()->after('text_en');
        });
    }

    public function down()
    {
        Schema::table('about', function (Blueprint $table) {
            $table->dropColumn(['text_az', 'text_en', 'text_ru']);
        });
    }
} 