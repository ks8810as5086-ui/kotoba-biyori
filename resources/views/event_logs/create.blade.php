<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-indigo-50 via-white to-pink-50 min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 px-4">

            <div class="mb-6">
                <a href="{{ route('daily_logs.index') }}"
                    class="text-sm text-gray-500 hover:text-sky-500 transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-line-cap="round" stroke-line-join="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    日報一覧へ戻る
                </a>
            </div>

            <div class="bg-white/80 backdrop-blur-md p-6 md:p-8 rounded-3xl shadow-xl border border-white/40">
                <div class="flex items-center gap-3 mb-6">
                    <span class="text-2xl">⏱️</span>
                    <h2 class="text-xl font-bold text-gray-800">感覚メモを残す</h2>
                </div>

                <form action="{{ route('event_logs.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <input type="hidden" name="event_date" value="{{ \Carbon\Carbon::today()->toDateString() }}">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="event_time" class="block text-sm font-medium text-gray-700 mb-2">発生時刻 <span
                                    class="text-red-400">*</span></label>
                            <input type="time" name="event_time" id="event_time"
                                value="{{ old('event_time', \Carbon\Carbon::now()->format('H:i')) }}"
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-gray-700">
                            <x-input-error :messages="$errors->get('event_time')" class="mt-1" />
                        </div>

                        <div>
                            <label for="weather" class="block text-sm font-medium text-gray-700 mb-2">その時の天気</label>
                            <select name="weather" id="weather"
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-gray-700">
                                <option value="">選択してください</option>
                                <option value="晴れ" {{ old('weather') == '晴れ' ? 'selected' : '' }}>☀️ 晴れ</option>
                                <option value="曇り" {{ old('weather') == '曇り' ? 'selected' : '' }}>☁️ 曇り</option>
                                <option value="雨" {{ old('weather') == '雨' ? 'selected' : '' }}>☔️ 雨</option>
                                <option value="雪" {{ old('weather') == '雪' ? 'selected' : '' }}>❄️ 雪</option>
                            </select>
                            <x-input-error :messages="$errors->get('weather')" class="mt-1" />
                        </div>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">出来事・タイトル <span
                                class="text-red-400">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            placeholder="例: 朝のミーティング、カフェでの注文"
                            class="w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-gray-700 placeholder-gray-300">
                        <x-input-error :messages="$errors->get('title')" class="mt-1" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">その瞬間の不安度 <span
                                class="text-red-400">*</span></label>
                        <div class="grid grid-cols-5 gap-2">
                            @foreach([1 => '😀 1', 2 => '🙂 2', 3 => '😐 3', 4 => '😰 4', 5 => '🤮 5'] as $level => $label)
                                <label
                                    class="flex flex-col items-center justify-center p-3 border border-gray-200 rounded-2xl cursor-pointer hover:bg-sky-50 transition-colors @if(old('anxiety_level') == $level) bg-sky-50 border-sky-300 ring-2 ring-sky-200 @endif">
                                    <input type="radio" name="anxiety_level" value="{{ $level }}" class="sr-only" {{ old('anxiety_level') == $level ? 'checked' : '' }}>
                                    <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('anxiety_level')" class="mt-1" />
                    </div>

                    <div class="border-t border-gray-100 my-6"></div>

                    <div class="space-y-4">
                        <div>
                            <label for="partner" class="block text-sm font-medium text-gray-600 mb-1">🤝
                                一緒にいた相手（任意）</label>
                            <input type="text" name="partner" id="partner" value="{{ old('partner') }}"
                                placeholder="例: 上司、店員"
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-300 text-sm text-gray-700 placeholder-gray-300">
                        </div>

                        <div>
                            <label for="place" class="block text-sm font-medium text-gray-600 mb-1">📍 いた場所（任意）</label>
                            <input type="text" name="place" id="place" value="{{ old('place') }}"
                                placeholder="例: 静かなオフィス、レジ前"
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-300 text-sm text-gray-700 placeholder-gray-300">
                        </div>

                        <div>
                            <label for="trigger_word" class="block text-sm font-medium text-gray-600 mb-1">💬
                                言いづらかった・トリガーとなった言葉（任意）</label>
                            <input type="text" name="trigger_word" id="trigger_word" value="{{ old('trigger_word') }}"
                                placeholder="例: 「おはようございます」「ホットコーヒー」"
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-300 text-sm text-gray-700 placeholder-gray-300">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-4 bg-gradient-to-r from-sky-400 to-blue-400 hover:from-sky-500 hover:to-blue-500 text-white font-medium rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-center block">
                            感覚メモを保存する
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[name="anxiety_level"]').forEach(radio => {
            radio.addEventListener('change', function () {
                // 一旦すべてのラベルのスタイルをリセット
                this.closest('.grid').querySelectorAll('label').forEach(label => {
                    label.classList.remove('bg-sky-50', 'border-sky-300', 'ring-2', 'ring-sky-200');
                });
                // 選択されたラジオボタンの親ラベルだけにスタイルを適用
                if (this.checked) {
                    this.closest('label').classList.add('bg-sky-50', 'border-sky-300', 'ring-2', 'ring-sky-200');
                }
            });
        });
    </script>
</x-app-layout>