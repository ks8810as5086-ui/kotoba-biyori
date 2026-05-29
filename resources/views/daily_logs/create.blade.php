<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                今日のまとめ
            </h2>
            <a href="{{ route('daily_logs.index') }}" class="text-sm text-sky-600 hover:text-sky-800 font-medium">
                ← 一覧に戻る
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                @if (session('success'))
                    <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('daily_logs.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block font-medium text-gray-700 mb-1 text-sm">日付</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}"
                            class="w-full sm:w-auto rounded-xl border-gray-200 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2 text-sm">今の状態 (1:低迷 〜 5:絶好調)</label>
                        <div class="flex items-center gap-4 mt-1">
                            @foreach(range(1, 5) as $i)
                                <label class="inline-flex items-center cursor-pointer group">
                                    <input type="radio" name="mood_score" value="{{ $i }}"
                                        class="text-sky-600 border-gray-300 focus:ring-sky-500 w-4 h-4" {{ $i == 3 ? 'checked' : '' }}>
                                    <span
                                        class="ml-2 text-gray-700 group-hover:text-sky-600 font-medium transition-colors">{{ $i }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1 text-sm">一言メモ（今の状態について）</label>
                        <textarea name="summary" rows="4"
                            class="w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-500 focus:ring-sky-500 placeholder-gray-400"
                            placeholder="今の気持ちや出来事を自由にメモしてください"></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full sm:w-auto text-center px-6 py-3 bg-gradient-to-r from-pink-400 to-amber-400 hover:from-pink-500 hover:to-amber-500 text-white font-semibold text-sm tracking-widest rounded-xl transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-1.5 border-none cursor-pointer">
                            <span>📝 まとめを保存する</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>