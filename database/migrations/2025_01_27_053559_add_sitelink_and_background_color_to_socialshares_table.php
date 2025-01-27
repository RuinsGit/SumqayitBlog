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
        Schema::table('socialshares', function (Blueprint $table) {
            $table->string('sitelink')->nullable()->after('link');
            $table->string('background_color')->nullable()->after('sitelink');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('socialshares', function (Blueprint $table) {
            $table->dropColumn('sitelink');
            $table->dropColumn('background_color');
        });
    }
}; 