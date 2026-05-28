<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventLog extends Model
{
    use HasFactory;

    // 一括代入可能なカラム
    protected $fillable = [
        'user_id',
        'event_date',
        'event_time',
        'title',
        'weather',
        'partner',
        'place',
        'trigger_word',
        'anxiety_level',
        'detail',
        'icon_path',
    ];

    // 型キャストメソッドにすることで、将来的に動的なキャストも定義しやすくなる
    protected function casts(): array
    {
        return [
            // 時刻として扱う事で、cabonインスタンスとして操作できるようになる
            'event_date' => 'date',// 'event_time' => 'time' だと、時間部分が切り捨てられてしまうため、datetimeでキャストしてから時間部分だけを扱う形にする
            'event_time' => 'datetime',
            'anxiety_level' => 'integer',
        ];
    }

    // リレーション：このイベントが属するユーザー
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
