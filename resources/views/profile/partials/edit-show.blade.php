<section class="w-2/3">
    <header>
        <h2 class="bg-sky-100 p-2 rounded-full text-3xl font-medium text-gray-900 dark:text-gray-100 leading-tight">
              {{$editUser->name}}{{ __('之個人資料') }}
        </h2>
    </header>

    <form method="post" action="{{ route('admin.update', ['editID' => $editUser->id]) }}" class="mt-6 space-y-6 w-full">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('姓名 Full Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block flex w-full" :value="old('name', $editUser->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('電話 Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $editUser->phone)" required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="fk_group_id" :value="__('職位 Position')" />
            <select id="fk_group_id" name="fk_group_id"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach($all_groups as $group)
                    <option value={{$group->group_id}} {{$group->group_id == $editUser->group->group_id ? 'selected="selected"' : '' }} >{{$group->group_name}}</option>
                @endforeach            
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('fk_group_id')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('信箱 Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $editUser->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $editUser->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('此用戶之Email尚未驗證') }}
                    </p>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end gap-4">
            <x-primary-button>{{ __('儲存') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{$editUser->name}}{{ __('的個人資料已更新！') }}</p>
            @endif
        </div>
    </form>
</section>
