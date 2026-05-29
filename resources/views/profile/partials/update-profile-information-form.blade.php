<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            プロフィール情報
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            アカウントの名前とメールアドレスを更新できます。
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="お名前" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full rounded-xl border-gray-200 focus:border-sky-500 focus:ring-sky-500"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="メールアドレス" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full rounded-xl border-gray-200 focus:border-sky-500 focus:ring-sky-500"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        メールアドレスが未認証です。

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            認証メールを再送する場合はこちらをクリックしてください。
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            新しい認証リンクが登録されたメールアドレスに送信されました。
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 bg-sky-500 hover:bg-sky-600 active:bg-sky-700 text-white font-medium text-sm rounded-xl tracking-wide shadow-sm hover:shadow transition-all duration-200 border-none cursor-pointer">
                変更を保存する
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium">保存しました！</p>
            @endif
        </div>
    </form>
</section>