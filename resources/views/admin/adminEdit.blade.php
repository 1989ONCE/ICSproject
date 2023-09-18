@section('title', '管理員編輯')

<x-app-layout>
    
    <x-slot name="scripts"></x-slot>

    <div class="grid justify-items-center xl:flex xl:flex-row">
        @include('profile.partials.sidebar')
        <!-- Main content -->
        <main class="pl-4 pr-2 ml-0 xl:ml-[250px] mt-2 w-fit min-w-48 xl:w-[900px] flex overflow-x-auto items-center">
            @include('profile.partials.edit-show')
        </main>
    </div>
</x-app-layout>