<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_histories', function (Blueprint $table) {
            $table->id(); // id (主キー)
            $table->unsignedBigInteger('user_id'); // user_id
            $table->unsignedBigInteger('deck_id'); // deck_id
            $table->unsignedBigInteger('question_locale_id'); // question_locale_id
            $table->boolean('is_finished')->default(false); // is_finished (デフォルト false)
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約 (必要に応じて外部テーブル名を変更)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deck_id')->references('id')->on('decks')->onDelete('cascade');
            $table->foreign('question_locale_id')->references('id')->on('locale_master')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_histories');
    }
}
