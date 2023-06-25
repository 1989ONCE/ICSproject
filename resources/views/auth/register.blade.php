@section('title', '註冊')
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Badge Number -->
        <div class="mb-4">
            <x-text-input id="badge_num" class="block mt-1 w-full" type="text" name="Badge_num" placeholder="員工識別號 Badge Number" :value="old('Badge_num')" required autofocus autocomplete="Badge_num" />
            <x-input-error :messages="$errors->get('Badge_num')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mb-4">
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="姓名 Full Name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="帳號 Email"  :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" placeholder="電話 Phone" :value="old('phone')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Position(Group) -->
        <div class="mb-4">
            <select id="group" name="group" class="bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>選擇你的職位(群組) Position</option>
                    @foreach($groups as $group)
                        <option value={{$group->group_id}}>{{$group->group_name}}</option>
                    @endforeach   
            </select>
            <x-input-error :messages="$errors->get('group')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder="密碼 Password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            placeholder="確認密碼 Confirm Your Password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __("已經有帳號了?") }}</span>
            <a href="{{route('login')}}">
                <span class="underline ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('登入') }}</span>
            </a>

            <x-primary-button class="ml-4">
                {{ __('註冊') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
