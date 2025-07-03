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
        Schema::create('festival_images', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('body', 200);
            $table->string('image_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //festival_imagesテーブルを削除
        Schema::dropIfExists('festival_images');
    }
};
