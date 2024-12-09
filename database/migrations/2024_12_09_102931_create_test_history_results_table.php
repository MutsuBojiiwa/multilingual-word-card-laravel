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
        Schema::create('test_history_results', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->unsignedBigInteger('test_history_id'); // 外部キー: test_histories
            $table->unsignedBigInteger('locale_id'); // 外部キー: locales または関連テーブル
            $table->integer('total_questions'); // 問題の総数
            $table->integer('correct_answers'); // 正解数
            $table->timestamps(); // 作成日時と更新日時

            // 外部キー制約
            $table->foreign('test_history_id')->references('id')->on('test_histories')->onDelete('cascade');
            $table->foreign('locale_id')->references('id')->on('locale_master')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_history_results');
    }
};
