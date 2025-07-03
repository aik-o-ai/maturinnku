<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('festivel_videos', function (Blueprint $table) {
            $table->id(); //主キー

            $table->unsignedBigInteger('event_id'); //festivalsテーブルのIDを参照する外部キー
            $table->unsignedBigInteger('user_id');     //usersテーブルのIDを参照する外部キー

            $table->text('question'); //動画に関連する質問内容を保存

            $table->timestamp('created_at')->useCurrent(); //作成日時

            //外部キー制約の設定
            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onDelete('cascade'); //まつりが削除されたら関連動画も削除

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade'); //ユーザーが削除されたら関連動画も削除

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        //festival_videosテーブルを削除
        Schema::dropIfExists('festivel_videos');
    }
};
