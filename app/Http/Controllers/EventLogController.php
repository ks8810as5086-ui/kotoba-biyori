<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventLogRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventLogController extends Controller
{
    // 感覚メモ入力画面を表示する
    public function create(): View
    {
        // resources/views/event_logs/create.blade.php を表示
        return view('event_logs.create');
    }

    // 感覚メモを保存する
    public function store(EventLogRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ログイン中のユーザーに紐づけて保存
        $user->eventLogs()->create($request->validated());

        // 保存後は、タイムラインが更新された日報一覧画面へ戻す
        return redirect()->route('daily_logs.index')->with('status', '感覚メモを記録しました！');
    }
}