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
        Schema::create('test_answer_locale_pivot', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->unsignedBigInteger('answer_locale_id'); // 外部キー: locales または関連する回答ロケール
            $table->unsignedBigInteger('test_history_id'); // 外部キー: test_histories
            $table->timestamps(); // 作成日時と更新日時

            // 外部キー制約
            $table->foreign('answer_locale_id')->references('id')->on('locale_master')->onDelete('cascade');
            $table->foreign('test_history_id')->references('id')->on('test_histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_answer_locale_pivot');
    }
};
