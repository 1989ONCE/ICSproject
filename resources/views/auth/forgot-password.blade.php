@section('title', '重設密碼')
<x-guest-layout>
    <div class="mb-4 text-md text-gray-600 dark:text-gray-400">
        {{ __('請輸入您註冊時使用之電子郵件地址。我們將向您發送一封含重設密碼連結的電子郵件。') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('發送連結') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
