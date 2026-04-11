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
        Schema::create('event_logs', function (Blueprint $table) {
            $table->id();
            //外部キー：daily_logsテーブルのIDと紐づけ
            $table->foreignId('daily_log_id')
                ->comment('紐づく日報のID')
                ->constrained()
                ->cascadeOnDelete();
            $table->time('event_time')->comment('発生時刻');
            $table->string('title')->comment('出来事のタイトル');
            $table->text('detail')->nullable()->comment('出来事の詳細');
            $table->string('icon_path',2048)->nullable()->comment('アイコンのパス');//URL対策
            $table->timestamps();
            //$table->index('daily_log_id'); 日報IDでインデックスを作成し、検索の高速化しようとしたが、foreignIdでconstrained()を使用しているため、自動的にインデックスが作成されるので不要
            $table->index(['daily_log_id', 'event_time']); // 日報ごとにイベントを時系列順で取得するための複合インデックス
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_logs');
    }
};
