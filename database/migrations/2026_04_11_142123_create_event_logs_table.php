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
            // 外部キー：daily_logsテーブルではなく、ユーザーに直接紐づける
            $table->foreignId('user_id')
                ->comment('紐づくユーザーの記録か')
                ->constrained()
                ->cascadeOnDelete();
            // 日付と時刻を分けて持たせる
            $table->date('event_date')->comment('発生日');
            $table->time('event_time')->comment('発生時刻');
            
            // 状況、コンディション(追加項目)
            $table->string('title')->nullable()->comment('出来事のタイトル(空っぽでもok)');
            $table->string('weather')->nullable()->comment('その時の天気');
            $table->string('partner')->nullable()->comment('相手（友人、店員など）');
            $table->string('place')->nullable()->comment('場所');
            $table->string('trigger_word')->nullable()->comment('言いづらかった言葉');
            $table->integer('anxiety_level')->nullable()->comment('予期不安の強さ');
            // 詳細、カスタマイズ
            $table->text('detail')->nullable()->comment('出来事の詳細');
            $table->string('icon_path', 2048)->nullable()->comment('アイコンのパス'); // URL対策
            $table->timestamps();
            // 複合インデックスを「ユーザー、日付、時刻」のセットに変更
            $table->index(['user_id','event_date','event_time']); // ユーザーごとに日付と時刻の組み合わせで検索しやすくするため
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
