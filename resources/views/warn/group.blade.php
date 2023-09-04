@section('title', '告警人員列表')

<x-app-layout>
    
    <x-slot name="scripts"></x-slot>

    <div class="grid justify-items-center xl:flex xl:flex-row">
        @include('warn.partials.sidebar')
        <!-- Main content -->
        <main class="pl-4 pr-2 ml-0 xl:ml-[250px] mt-2 w-fit min-w-48 xl:w-[900px] flex flex-row overflow-x-auto items-center">
            @include('warn.partials.group-mgt')
        </main>
    </div>
</x-app-layout>
