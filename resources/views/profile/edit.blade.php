@section('title', '更新資料')

<x-app-layout>
    <x-slot name="scripts"></x-slot>

    <div class="grid justify-items-center xl:flex xl:flex-row">
        @include('profile.partials.sidebar')
        <!-- Main content -->
        <div class="pl-4 pr-2 ml-0 xl:ml-[250px] mt-2 w-full min-w-48 xl:w-[900px] flex flex-col overflow-x-auto items-start">
            <div class="w-full p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.lineconnect')
                </div>
            </div>
            <div class="w-full mt-10 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="w-full mt-10 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="w-full my-10 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
