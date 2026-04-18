<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            日報作成
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('daily_logs.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">日付</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}"
                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">今の状態 (1:低迷 〜 5:絶好調)</label>
                        <div class="flex items-center gap-4 mt-1">
                            @foreach(range(1, 5) as $i)
                                <label class="inline-flex items-center">
                                    <input type="radio" name="mood_score" value="{{ $i }}"
                                        class="text-indigo-600 focus:ring-indigo-500" {{ $i == 3 ? 'checked' : '' }}>
                                    <span class="ml-2">{{ $i }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">一言メモ（今の状態について）</label>
                        <textarea name="summary" rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="今の気持ちや出来事を自由にメモしてください"></textarea>
                    </div>

                    <x-primary-button>
                        日報を保存する
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>