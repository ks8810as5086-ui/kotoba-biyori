<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ことば日和 - あなたの言葉に寄り添う日報アプリ</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body {
            font-family: 'Noto Sans JP', 'Figtree', sans-serif;
        }
    </style>
</head>

<body
    class="antialiased bg-gradient-to-br from-indigo-50 via-white to-pink-50 min-h-screen flex flex-col justify-between">

    <header class="w-full max-w-7xl mx-auto px-6 py-4 flex justify-end">
        @if (Route::has('login'))
            <nav class="flex gap-4">
                @auth
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm text-gray-400 hover:text-sky-500 transition-colors duration-200">ログイン</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="text-sm text-gray-400 hover:text-sky-500 transition-colors duration-200">新規登録</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main class="flex-grow flex items-center justify-center px-4">
        <div
            class="max-w-xl w-full text-center bg-white/60 backdrop-blur-md p-8 md:p-12 rounded-3xl shadow-xl border border-white/40">
    
            <div class="flex justify-center mb-2">
                <img src="{{ asset('images/882958ea-3068-4ef9-bfd7-d9cd9c814ba3.png') }}" alt="ことば日和 ロゴ"
                    class="w-64 h-auto object-contain">
            </div>
    
            <p class="text-base md:text-lg text-gray-600 leading-relaxed mb-8 mt-2">
                その日の出来事や心のうつりかわりを、<br class="hidden sm:inline">
                あなただけの特別な「ことば」で紡ぐ日報アプリケーション。
            </p>
    
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                @auth
                    <a href="{{ route('daily_logs.index') }}"
                        class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-sky-400 to-blue-400 hover:from-sky-500 hover:to-blue-500 text-white font-medium rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                        <span>マイページを開く</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-sky-400 to-blue-400 hover:from-sky-500 hover:to-blue-500 text-white font-medium rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-center">
                            はじめる（新規登録）
                        </a>
                    @endif
                    <a href="{{ route('login') }}"
                        class="w-full sm:w-auto px-8 py-4 bg-white hover:bg-sky-50/50 text-gray-700 font-medium rounded-xl shadow-sm hover:shadow border border-gray-200 transition-all duration-200 text-center">
                        アカウントをお持ちの方
                    </a>
                @endauth
            </div>
    
        </div>
    </main>

    <footer class="w-full text-center py-6 text-sm text-gray-400">
        &copy; {{ date('Y') }} ことば日和. All rights reserved.
    </footer>

</body>

</html>