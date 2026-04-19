<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\validation\Rule;
class DailyLogController extends Controller
{
    //日報一覧を表示する
    public function index(): View
{
    // ログインしているユーザーの日報を、日付の降順で取得
    /**@var App\Models\User $user */
        $user = Auth::user();
        $dailyLogs = $user->dailyLogs()->latest('date')->get();
    return view('daily_logs.index',compact('dailyLogs'));
}
    //日報入力画面を表示する
    public function create(): View
    {
        //resources/views/daily_logs/create.blade.phpを表示
        return view('daily_logs.create');
    }
    //日報を保存する
    public function store(Request $request): RedirectResponse
    {
        //バリデーションルールを定義
        $validated = $request->validate([
            'date' => [
                'required',
                'date',
                //同じユーザーが同じ日に複数の日報を作成できないようにするルール
                Rule::unique('daily_logs')->where(fn ($query) => $query->where('user_id', Auth::id())),
                ],
            'mood_score' => 'required|integer|min:1|max:5',
            'summary' => 'nullable|string|max:1000',
        ]);
        //日報を保存
        /** @var User $user */
        $user = Auth::user();
        $user->dailyLogs()->create($validated);
        //日報一覧ページにリダイレクト
        return redirect()->route('daily_logs.index')->with('success', '日報が保存されました。');
    }
}
