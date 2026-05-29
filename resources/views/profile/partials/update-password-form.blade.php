<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            パスワード変更
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            安全性を保つため、定期的で予測されにくい長めのパスワードへの更新をおすすめします。
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="現在のパスワード" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full rounded-xl border-gray-200 focus:border-sky-500 focus:ring-sky-500"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="新しいパスワード" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full rounded-xl border-gray-200 focus:border-sky-500 focus:ring-sky-500"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="新しいパスワード（確認用）" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full rounded-xl border-gray-200 focus:border-sky-500 focus:ring-sky-500"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 bg-sky-500 hover:bg-sky-600 active:bg-sky-700 text-white font-medium text-sm rounded-xl tracking-wide shadow-sm hover:shadow transition-all duration-200 border-none cursor-pointer">
                パスワードを更新する
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium">更新しました！</p>
            @endif
        </div>
    </form>
</section>