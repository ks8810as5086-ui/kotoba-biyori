<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class DailyLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * バリデーションルールを取得する
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //updateはルートから現在の日報モデルを取得できる
        $dailyLog = $this->route('dailyLog');
        return [
            'date' => [
                'required',
                'date',
                //同じユーザーが同じ日に複数の日報を作成できないようにするルール
                Rule::unique('daily_logs')->where(fn ($query) => $query->where('user_id', auth::id()))->ignore($dailyLog?->id),
            ],
            'mood_score' => 'required|integer|min:1|max:5',
            'summary' => 'nullable|string|max:1000',
        ];
    }
}
