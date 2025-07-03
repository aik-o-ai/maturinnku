<?php

//Laravelのマイグレーション機能を使うための基底クラスをインポート
use Illuminate\Database\Migrations\Migration;

//テーブル定義用の設計図(Blueprint)クラスをインポート
use Illuminate\Database\Schema\Blueprint;

//スキーマ捜査用のschemaファサード（簡単に使える窓口）をインポート
use Illuminate\Support\Facades\Schema;


class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); //主キー

            $table->unsignedBigInteger('user_id'); //投稿者(usersテーブルとリレーション)
            $table->string('event_title'); //タイトル
            $table->text('event_body'); //説明文

            $table->date('start_date')->comment('開始日');
            $table->date('end_date')->comment('終了日');
            $table->string('prefecture'); //都道府県
            $table->string('location'); //具体的な場所
            $table->decimal('latitude', 10, 7); //緯度
            $table->decimal('longitude', 10, 7); //経度
            $table->string('event_color')->comment('背景色');
            $table->string('event_border_color')->comment('枠線色');

            $table->timestamps(); // created_at, updated_at の両方を追加

            //外部キー制約(usersテーブルのidに紐づけ)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //festivalsテーブルを削除
        Schema::dropIfExists('events');
    }
};
