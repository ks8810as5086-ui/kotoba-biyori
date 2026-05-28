<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventLog;
use App\Models\User;
use App\Models\DailyLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EventLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1.テストユーザーの作成(ログイン用)
        $user = User::create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'mode' => 'self',
        ]);
        //今日、昨日、一昨日の３日分のデータを作る
        $dates = [
            Carbon::today(),
            Carbon::yesterday(),
            Carbon::yesterday()->subDay(2),
        ];
        //2.日報とイベントログの作成
        foreach ($dates as $index => $date) {
            $dateStr = $date->toDateString();

            // 日報データ（daily_logs）の作成
            DailyLog::create([
                'user_id' => $user->id,
                'date' => $dateStr,
                'mood_score' => 4 - $index, // 4, 3, 2 と変化させる
                'summary' => $dateStr . " の日報です。レバンガ北海道の試合を観戦しました。自分のペースを意識して過ごせました。",
            ]);

            // その日のリアルタイムイベント（event_logs）を2件ずつ作成
            EventLog::create([
                'user_id' => $user->id,
                'event_date' => $dateStr,
                'event_time' => '10:30:00',
                'title' => '朝のミーティング',
                'weather' => '晴れ',
                'partner' => '上司',
                'place' => '静かなオフィス',
                'trigger_word' => 'おはようございます',
                'anxiety_level' => 2,
                'detail' => '少し緊張したけれど、ゆっくり話すことを意識したら挨拶がスムーズにできた。',
            ]);

            EventLog::create([
                'user_id' => $user->id,
                'event_date' => $dateStr,
                'event_time' => '15:15:00',
                'title' => 'カフェでの注文',
                'weather' => 'くもり',
                'partner' => '店員',
                'place' => 'レジ前',
                'trigger_word' => 'ホットコーヒー',
                'anxiety_level' => 3,
                'detail' => '後ろに人が並んでいて予期不安が強くなった。少し詰まったけれど、店員さんが優しく待ってくれた。',
            ]);
        }
    }
}
