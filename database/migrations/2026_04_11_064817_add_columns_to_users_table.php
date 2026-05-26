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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('mode', ['self', 'family'])->default('self')->after('email'); // ユーザーの利用モード(self:自分,family:家族)
            $table->string('photo_path', 2048)->nullable()->after('mode'); // 背景の画像パス(URLで長くなることを想定)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'mode')) {
                $table->dropColumn('mode');
            }
            if (Schema::hasColumn('users', 'photo_path')) {
                $table->dropColumn('photo_path');
            }
        });
    }
};
