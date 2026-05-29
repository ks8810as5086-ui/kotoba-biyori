<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            アカウントの削除
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            アカウントを削除すると、これまでに記録したすべてのデータが完全に削除され、元に戻すことができなくなります。大切なデータがある場合は、事前に内容をお控えください。
        </p>
    </header>

    <button type="button"
        class="inline-flex items-center px-5 py-2.5 bg-rose-500 hover:bg-rose-600 active:bg-rose-700 text-white font-medium text-sm rounded-xl tracking-wide shadow-sm hover:shadow transition-all duration-200 border-none cursor-pointer"
        x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        アカウントを削除する
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                本当にアカウントを削除しますか？
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                アカウントの削除を確定するには、パスワードを入力してください。
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="パスワード" class="sr-only" />

                <x-text-input id="password" name="password" type="password"
                    class="mt-1 block w-full sm:w-3/4 rounded-xl border-gray-200 focus:border-sky-500 focus:ring-sky-500"
                    placeholder="パスワードを入力してください" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button"
                    class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-medium text-sm rounded-xl transition-all duration-200 cursor-pointer"
                    x-on:click="$dispatch('close')">
                    キャンセル
                </button>

                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 bg-rose-500 hover:bg-rose-600 active:bg-rose-700 text-white font-medium text-sm rounded-xl tracking-wide shadow-sm hover:shadow transition-all duration-200 border-none cursor-pointer">
                    アカウントを完全に削除
                </button>
            </div>
        </form>
    </x-modal>
</section>