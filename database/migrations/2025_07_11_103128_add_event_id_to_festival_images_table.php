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
        Schema::table('festival_images', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->after('id'); // 'id' の後に追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('festival_images', function (Blueprint $table) {
            $table->dropColumn('event_id');
        });
    }
};
