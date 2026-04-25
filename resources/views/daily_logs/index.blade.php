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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($dailyLogs->isEmpty())
                    <p class="text-gray-500 text-center">まだ日報がありません。</p>
                @else
                    <div class="space-y-4">
                        @foreach($dailyLogs as $log)
                            <div class="border-b pb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-bold text-lg text-gray-700">{{ \Carbon\Carbon::parse($log->date)->locale('ja')->isoFormat('LL(ddd)') }}</span>
                                    <span
                                        class="px-3 py-1 rounded-full text-sm {{ $log->mood_score >= 4 ? 'bg-green-100 text-green-800' : ($log->mood_score <= 2 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        状態: {{ $log->mood_score }}
                                    </span>
                                </div>
                                <p class="text-gray-600 whitespace-pre-wrap">{{ $log->summary }}</p>
                                <div class="flex items-center space-x-4 text-sm">
                                    {{-- 編集ボタン --}}
                                    <a href="{{ route('daily_logs.edit', $log) }}" class="text-blue-600 hover:text-blue-800 flex items-center">
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
                                        <button type="submit" class="text-red-600 hover:text-red-800 flex items-center">
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
    </div>
</x-app-layout>