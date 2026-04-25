<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            日報編集
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
                            class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="mood_score" class="block text-gray-700 font-bold mb-2">気分 (1-5)</label>
                        <input type="number" name="mood_score" id="mood_score" min="1" max="5"
                            value="{{ old('mood_score', $dailyLog->mood_score) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('mood_score') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="summary" class="block text-gray-700 font-bold mb-2">内容</label>
                        <textarea name="summary" id="summary" rows="5"
                            class="w-full border-gray-300 rounded-md shadow-sm">{{ old('summary', $dailyLog->summary) }}</textarea>
                        @error('summary') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('daily_logs.index') }}" class="text-gray-600 mr-4">キャンセル</a>
                        <x-primary-button>更新する</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>