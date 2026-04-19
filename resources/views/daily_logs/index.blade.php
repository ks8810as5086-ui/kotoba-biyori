<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('日報一覧') }}
            </h2>
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
                                    <span class="font-bold text-lg text-gray-700">{{ $log->date }}</span>
                                    <span
                                        class="px-3 py-1 rounded-full text-sm {{ $log->mood_score >= 4 ? 'bg-green-100 text-green-800' : ($log->mood_score <= 2 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        状態: {{ $log->mood_score }}
                                    </span>
                                </div>
                                <p class="text-gray-600 whitespace-pre-wrap">{{ $log->summary }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>