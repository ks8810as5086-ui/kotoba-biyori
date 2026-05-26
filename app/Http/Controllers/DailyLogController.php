<?php

namespace App\Http\Controllers;

use App\Http\Requests\DailyLogRequest;
use App\Models\DailyLog;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DailyLogController extends Controller
{
    use AuthorizesRequests;

    // 日報一覧を表示する
    public function index(): View
    {
        // ログインしているユーザーの日報を、日付の降順で取得
        /** @var User $user */
        $user = Auth::user();

        $dailyLogs = $user->dailyLogs()->latest('date')->get();

        return view('daily_logs.index', compact('dailyLogs'));
    }

    // 日報入力画面を表示する
    public function create(): View
    {
        // resources/views/daily_logs/create.blade.phpを表示
        return view('daily_logs.create');
    }

    // 日報を保存する
    public function store(DailyLogRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->dailyLogs()->create($request->validated());

        return redirect()->route('daily_logs.index')->with('status', '日報が保存されました。');
    }

    public function edit(DailyLog $dailyLog)
    {
        // ポリシーのauthorizeメソッドを使用して、ユーザーが日報を編集する権限があるかを確認
        $this->authorize('update', $dailyLog);

        return view('daily_logs.edit', compact('dailyLog'));
    }

    public function update(DailyLogRequest $request, DailyLog $dailyLog)
    {
        $this->authorize('update', $dailyLog);
        $validated = $request->validated();
        $dailyLog->update($validated);

        return redirect()->route('daily_logs.index')->with('status', '日報を更新しました!');
    }

    public function destroy(DailyLog $dailyLog)
    {
        $this->authorize('delete', $dailyLog);
        $dailyLog->delete();

        return redirect()->route('daily_logs.index')->with('status', '日報を削除しました!');
    }
}
