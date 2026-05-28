<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'mood_score',
        'summary',
    ];

    // 型キャストメソッドにすることで、将来的に動的なキャストも定義しやすくなる
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'mood_score' => 'integer',
        ];
    }

    // リレーション：ユーザー(この日報の所有者)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // リレーション：イベントログ(この日報に関連するすべての出来事)を削除した。
}
