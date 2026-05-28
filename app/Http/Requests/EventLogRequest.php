<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EventLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // 感覚メモのバリデーションルール
    public function rules(): array
    {
        return [
            // 本日の日付（YYYY-MM-DD）を自動でセットするための隠しフィールド
            'event_date'   => ['required', 'date'], 
            // 発生時刻（HH:MM）
            'event_time'   => ['required'], 
            // 出来事・タイトル（必須、50文字以内）
            'title'        => ['required', 'string', 'max:50'], 
            // 天気（任意、20文字以内）
            'weather'      => ['nullable', 'string', 'max:20'],
            // 不安度レベル（1〜5の数値、必須）
            'anxiety_level'=> ['required', 'integer', 'between:1,5'], 
            // 相手（任意、50文字以内）
            'partner'      => ['nullable', 'string', 'max:50'], 
            // 場所（任意、50文字以内）
            'place'        => ['nullable', 'string', 'max:50'], 
            // トリガーとなった言葉（任意、100文字以内）
            'trigger_word' => ['nullable', 'string', 'max:100'], 
        ];
    }

    // エラーメッセージの日本語化
    public function attributes(): array
    {
        return [
            'title' => 'タイトル（出来事）',
            'event_time' => '発生時刻',
            'anxiety_level' => '不安度レベル',
            'weather' => '天気',
        ];
    }
}
