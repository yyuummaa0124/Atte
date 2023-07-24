<x-guest-layout>
    <x-auth-card>
        <x-slot name="title">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">会員登録</h2>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class="login-card" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input id="name" class="mt-1 w-full input-box" type="text" name="name" :value="old('name')" required autofocus placeholder="名前"/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input id="email" class="mt-1 w-full input-box" type="email" name="email" :value="old('email')" required placeholder="メールアドレス"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input id="password" class="mt-1 w-full input-box"
                                type="password"
                                name="password"
                                required autocomplete="new-password" 
                                placeholder="パスワード" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input id="password_confirmation" class="mt-1 w-full input-box"
                                type="password"
                                name="password_confirmation" required 
                                placeholder="確認用パスワード" />
            </div>

            <x-button class="login-btn background-blue">
                {{ __('会員登録') }}
            </x-button>

            <div class="block mt-4">
                    <span class="ml-2 text-sm text-gray-600">{{ __('アカウントをお持ちの方はこちら') }}</span>
            </div>

            <div class="flex items-center justify-center">
                <a class="text-sm text-blue font-semibold" href="{{ route('login') }}">
                    {{ __('ログイン') }}
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
