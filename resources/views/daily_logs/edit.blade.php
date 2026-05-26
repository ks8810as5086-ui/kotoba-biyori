<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('日報編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- 更新用のフォーム --}}
                <form action="{{ route('daily_logs.update', $dailyLog) }}" method="POST">
                    @csrf
                    @method('PATCH') {{-- これが超重要！ --}}

                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 font-bold mb-2">日付</label>
                        <input type="date" name="date" id="date" value="{{ old('date', $dailyLog->date) }}"
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="mood_score" class="block text-gray-700 font-bold mb-2">気分 (1-5)</label>
                        <input type="number" name="mood_score" id="mood_score" min="1" max="5"
                            value="{{ old('mood_score', $dailyLog->mood_score) }}"
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('mood_score') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="summary" class="block text-gray-700 font-bold mb-2">内容</label>
                        <textarea name="summary" id="summary" rows="5"
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('summary', $dailyLog->summary) }}</textarea>
                        @error('summary') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- 【UI/UX改善】ボタン配置エリア：境界線、絶妙な余白、高さを揃えた配置 --}}
                    <div class="flex items-center justify-end space-x-3 border-t pt-6 border-gray-100 mt-6">

                        {{-- キャンセルボタン：白背景に枠線をつけて「戻る」の役割をわかりやすく --}}
                        <a href="{{ route('daily_logs.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            キャンセル
                        </a>

                        {{-- 更新ボタン：既存のコンポーネントをそのまま使い、サイズ感をキャンセルと同一に調整 --}}
                        <x-primary-button class="shadow-sm">
                            {{ __('更新する') }}
                        </x-primary-button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>