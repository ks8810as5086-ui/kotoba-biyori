<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('ことばのグラデーション') }}
            </h2>
            
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('event_logs.create') }}" 
                class="flex-1 sm:flex-initial text-center px-4 py-2.5 bg-white text-sky-600 hover:bg-sky-50 font-semibold text-xs uppercase tracking-widest rounded-xl border border-sky-200 transition ease-in-out duration-150 flex items-center justify-center gap-1.5 shadow-sm">
                    <span>⏱️ 感覚メモを残す</span>
                </a>

                <a href="{{ route('daily_logs.create') }}"
                class="flex-1 sm:flex-initial text-center px-4 py-2.5 bg-gradient-to-r from-pink-400 to-amber-400 hover:from-pink-500 hover:to-amber-500 text-white font-semibold text-xs uppercase tracking-widest rounded-xl transition-all duration-200 shadow-sm hover:shadow flex items-center justify-center gap-1.5">
                    <span>📝 今日のまとめを書く</span>
                </a>
                <a href="{{ route('daily_logs.graph') }}" 
                class="flex-1 sm:flex-initial text-center px-4 py-2.5 bg-white text-gray-600 hover:bg-gray-50 font-semibold text-xs uppercase tracking-widest rounded-xl border border-gray-200 transition ease-in-out duration-150 flex items-center justify-center gap-1.5 shadow-sm">
                    <span>📊 最近のグラフを見る</span>
                </a>
            </div>
        </div>
    </x-slot>

    @if (session('status'))
        <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
            <div class="font-medium text-sm text-green-600 bg-green-50 border border-green-200 px-4 py-3 rounded-xl shadow-sm flex items-center gap-2">
                <span>✨</span> {{ session('status') }}
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($dailyLogs->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-500 text-center">まだ日報がありません。</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($dailyLogs as $log)
                        <div class="bg-white overflow-hidden shadow-md hover:shadow-xl rounded-xl p-6 flex flex-col justify-between transition-shadow duration-300 border border-gray-100">
                            
                            <div>
                                {{-- ヘッダー部分：日付と気分 --}}
                                <div class="flex justify-between items-start mb-4">
                                    <span class="font-bold text-lg text-gray-800">
                                        {{ \Carbon\Carbon::parse($log->date)->locale('ja')->isoFormat('LL(ddd)') }}
                                    </span>
                                    
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        {{ $log->mood_score >= 4 ? 'bg-green-50 text-green-700 border border-green-200' : ($log->mood_score <= 2 ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-yellow-50 text-yellow-700 border border-yellow-200') }}">
                                        <span class="mr-1 text-base">
                                            @switch($log->mood_score)
                                                @case(5) 😊 @break
                                                @case(4) 🙂 @break
                                                @case(3) 😐 @break
                                                @case(2) 🙁 @break
                                                @case(1) 😢 @break
                                                @default 😐
                                            @endswitch
                                        </span>
                                        スコア: {{ $log->mood_score }}
                                    </span>
                                </div>

                                {{-- 本文（要約） --}}
                                <p class="text-gray-600 text-sm whitespace-pre-wrap leading-relaxed mb-4">{{ $log->summary }}</p>

                                {{-- その日のリアルタイムイベントログのタイムライン表示 --}}
                                @php
                                    $logDateStr = \Carbon\Carbon::parse($log->date)->toDateString();
                                    $dayEvents = $eventLogs[$logDateStr] ?? null;
                                @endphp

                                @if ($dayEvents)
                                    <div class="mt-4 pt-3 border-t border-dashed border-gray-100 space-y-2 mb-4">
                                        <div class="text-xs font-semibold text-gray-400 tracking-wider uppercase mb-1">
                                            ⏱️ その日の感覚メモ
                                        </div>
                                        @foreach ($dayEvents as $event)
                                            <div class="bg-sky-50/60 hover:bg-sky-50 border border-sky-100/50 p-2.5 rounded-lg transition-colors duration-150">
                                                <div class="flex items-center justify-between mb-1">
                                                    <div class="flex items-center space-x-2">
                                                        {{-- 発生時刻 --}}
                                                        <span class="text-xs font-bold text-sky-700 whitespace-nowrap">
                                                            {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}
                                                        </span>

                                                        {{-- 天気バッジ --}}
                                                        @if(!empty($event->weather))
                                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-md bg-white/80 text-[10px] text-gray-500 border border-gray-100/80 shadow-sm font-medium whitespace-nowrap">
                                                    
                                                                @switch($event->weather)
                                                                    @case('晴れ') ☀️ @break
                                                                    @case('くもり') ☁️ @break
                                                                    @case('雨') ☔️ @break
                                                                    @case('雪') ❄️ @break
                                                                    @default 🌈
                                                                @endswitch
                                                                <span class="ms-0.5 text-gray-400">{{ $event->weather }}</span>
                                                            </span>
                                                        @endif

                                                        {{-- タイトル --}}
                                                        <span class="text-xs font-bold text-gray-700 truncate max-w-[120px]">
                                                            {{ $event->title ?? '(タイトルなし)' }}
                                                        </span>
                                                    </div>
                                                    
                                                    {{-- 不安度レベルのバッジ --}}
                                                    @if($event->anxiety_level !== null)
                                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                                            不安度: {{ $event->anxiety_level }}
                                                        </span>
                                                    @endif
                                                </div>

                                                {{-- メモの補足情報 --}}
                                                @if($event->partner || $event->place || $event->trigger_word)
                                                    <div class="text-[11px] text-gray-500 space-x-1 truncate">
                                                        @if($event->partner) <span>👤 {{ $event->partner }}</span> @endif
                                                        @if($event->place) <span>📍 {{ $event->place }}</span> @endif
                                                        @if($event->trigger_word) <span class="text-indigo-600 font-medium">💬「{{ $event->trigger_word }}」</span> @endif
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- フッター部分：アクションボタン --}}
                            <div class="flex items-center justify-end space-x-4 text-sm border-t pt-4 border-gray-100">
                                {{-- 編集ボタン --}}
                                <a href="{{ route('daily_logs.edit', $log) }}" class="text-indigo-600 hover:text-indigo-900 font-medium flex items-center transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    編集
                                </a>

                                {{-- 削除ボタン --}}
                                <form action="{{ route('daily_logs.destroy', $log) }}" method="POST"
                                    onsubmit="return confirm('この日報を削除してもよろしいですか？');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium flex items-center transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        削除
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- ページネーション --}}
                <div class="mt-8">
                    {{ $dailyLogs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>