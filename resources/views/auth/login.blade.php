<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h1 class="text-2xl font-bold text-gray-800 tracking-wide">ことば日和</h1>
        <p class="text-xs text-gray-500 mt-1">おかえりなさい。今日のまとめを記録しましょう。</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="メールアドレス" />
            <x-text-input id="email"
                class="block mt-1 w-full rounded-xl border-gray-200 focus:border-sky-500 focus:ring-sky-500"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="パスワード" />
            <x-text-input id="password"
                class="block mt-1 w-full rounded-xl border-gray-200 focus:border-sky-500 focus:ring-sky-500"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-sky-500 shadow-sm focus:ring-sky-500 w-4 h-4 cursor-pointer"
                    name="remember">
                <span
                    class="ms-2 text-sm text-gray-600 group-hover:text-sky-600 font-medium transition-colors">ログイン状態を保存する</span>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-500 hover:text-sky-600 transition-colors underline decoration-gray-300 hover:decoration-sky-500"
                    href="{{ route('password.request') }}">
                    パスワードをお忘れですか？
                </a>
            @endif

            <button type="submit"
                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-sky-500 hover:bg-sky-600 active:bg-sky-700 text-white font-semibold text-sm rounded-xl tracking-wide shadow-sm hover:shadow transition-all duration-200 border-none cursor-pointer">
                ログインする
            </button>
        </div>
    </form>
</x-guest-layout>
