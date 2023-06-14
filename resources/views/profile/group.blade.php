@section('title', '群組管理')

<x-app-layout>
    
    <x-slot name="scripts"></x-slot>

    <div class="flex">
        @include('profile.partials.sidebar')
        <!-- Main content -->
        <main class="mx-[250px] mt-10 w-9/12">
            @include('profile.partials.group-mgt')
        </main>
    </div>
</x-app-layout>
