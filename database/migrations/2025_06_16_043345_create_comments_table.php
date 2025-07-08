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
    public function up(): void
    {
        //コメントテーブルを作成
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); //主キー

            $table->unsignedBigInteger('event_id'); //紐づく祭りのID
            $table->unsignedBigInteger('user_id');     //コメントしたユーザーのID

            $table->text('comment'); //コメント内容

            $table->timestamp('create_at')->useCurrent(); //作成日時

            //外部キー制約
            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down(): void
    {
        //contentsテーブルを削除
        Schema::dropIfExists('comments');
    }
};
