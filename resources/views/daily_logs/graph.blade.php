<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">気分の推移グラフ</h2>
            <a href="{{ route('daily_logs.index') }}" class="text-sm text-sky-600 hover:text-sky-800 font-medium">
            ことばのグラデーションに戻る
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                @if(isset($hasData) && $hasData === false)
                    <p class="text-gray-500">まだグラフにするデータがありません。</p>
                @else
                    <canvas id="moodChart"></canvas>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                       // 1. コントローラーからデータをJSONで受け取る
                        const labels = @json($labels);
                        const scores = @json($scores);

                        // 2. グラフを描画する（初期化コード）
                        const ctx = document.getElementById('moodChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: '気分のスコア',
                                    data: scores,
                                    borderColor: 'rgb(59, 130, 246)',
                                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                    fill: true,
                                    tension: 0.3
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        max: 5
                                    }
                                }
                            }
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>