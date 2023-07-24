
<x-guest-layout>

    <x-auth-card>

        <x-slot name="title">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight" >
                    {{ __('ログイン') }}
                </h2>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class="login-card" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input id="email" class="mt-1 input-box" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input id="password" class="mt-1 w-full input-box"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="パスワード" />
            </div>

                <x-button class="login-btn background-blue" >
                        {{ __('ログイン') }}
                </x-button>

            <!-- Remember Me -->
            <div class="block mt-4">
                    <span class="ml-2 text-sm text-gray-600">{{ __('アカウントをお持ちでない方はこちら') }}</span>
            </div>

            <div class="flex items-center justify-center">
                <a class="text-sm text-blue font-semibold" href="{{ route('register') }}">
                    {{ __('会員登録') }}
                </a>
            </div>


            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
