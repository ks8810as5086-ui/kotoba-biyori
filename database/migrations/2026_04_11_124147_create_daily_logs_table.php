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
        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id();
            //外部キー：どのユーザーの記録か(usersテーブルのidと紐づけ)
            $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->date('date')->comment('記録日(1日1件)');
            $table->unsignedTinyInteger('mood_score')->comment('気分スコア(1:低~5:高)');
            $table->text('summary')->nullable()->comment('その日の総括(ひとこと)');
            $table->timestamps();
            $table->unique(['user_id','date']); //ユーザーごとに日付の重複を許さない(1日1件)
            //$table->index(['user_id','date']); ユーザーIDと日付でインデックスを作成し、検索の高速化しようとしたが、unique制約があるため不要
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_logs');
    }
};
