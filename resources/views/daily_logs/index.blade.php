<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('日報一覧') }}
            </h2>
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 border border-green-400 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif
            <a href="{{ route('daily_logs.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                新規作成
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- アプリ全体の背景を少しグレーにし、カードを引き立たせるため、ここでの背景白（bg-white）と枠（shadow-sm）を外してグリッドを配置 --}}
            @if($dailyLogs->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-500 text-center">まだ日報がありません。</p>
                </div>
            @else
                {{-- 【レスポンシブグリッド】スマホなら1列(grid-cols-1)、タブレットなら2列(sm:grid-cols-2)、PCなら3列(lg:grid-cols-3) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($dailyLogs as $log)
                        {{-- 【立体感のあるホワイトカード】 --}}
                        <div class="bg-white overflow-hidden shadow-md hover:shadow-xl rounded-xl p-6 flex flex-col justify-between transition-shadow duration-300 border border-gray-100">
                            
                            <div>
                                {{-- ヘッダー部分：日付と気分 --}}
                                <div class="flex justify-between items-start mb-4">
                                    <span class="font-bold text-lg text-gray-800">
                                        {{ \Carbon\Carbon::parse($log->date)->locale('ja')->isoFormat('LL(ddd)') }}
                                    </span>
                                    
                                    {{-- 【数字を可愛い絵文字バッジに変換】 --}}
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

                                {{-- 本文（要約）：カード内で文字があふれないよう、適度な高さを保つ --}}
                                <p class="text-gray-600 text-sm whitespace-pre-wrap leading-relaxed mb-6">{{ $log->summary }}</p>
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
            @endif
        </div>
    </div>
</x-app-layout>