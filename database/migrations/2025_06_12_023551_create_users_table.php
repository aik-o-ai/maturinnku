<?php

//Laravelのマイグレーション機能を使うための基底クラスをインポート
use Illuminate\Database\Migrations\Migration;

//テーブル定義用の設計図(Blueprint)クラスをインポート
use Illuminate\Database\Schema\Blueprint;

//スキーマ捜査用のschemaファサード（簡単に使える窓口）をインポート
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
        //テーブル作成の処理
        Schema::create('users', function (Blueprint $table) {
            $table->id(); //主キー(bigIncremants)
            $table->string('name'); //名前
            $table->string('email')->unique(); //メールアドレス（ユニーク）
            $table->string('password'); //パスワード
            $table->integer('age')->nullable(); //年齢
            $table->string('image_pass')->nullable(); //画像のパス
            $table->timestamps(); //created_at, updated_at の両方を作成
        });
    }
    /**
     * Reverse the migrations.
     * 
     * @return video
     */
    public function down()
    {
        //usersテーブルを削除
        Schema::dropIfExists('users');
    }
};
