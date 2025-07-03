<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id(); //主キー
            $table->unsignedBigInteger('q_and_a_id'); //対応するQ&Aまたは質問のID
            $table->unsignedBigInteger('user_id');    //回答したユーザーのID

            $table->text('answer'); //回答内容

            $table->timestamp('created_at')->useGurrent(); //作成日時

            //外部キー制約
            $table->foreign('q_and_a_id')
                ->references('id')->on('questions') //質問テーブルを参照
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users') //ユーザーテーブルを参照
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
};
