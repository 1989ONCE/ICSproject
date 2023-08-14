@section('title', '告警人員列表')

<x-app-layout>
    
    <x-slot name="scripts"></x-slot>

    <div class="flex">
        @include('warn.partials.sidebar')
        <!-- Main content -->
        <main class="mx-[250px] mt-2 w-9/12">
            @include('warn.partials.group-mgt')
        </main>
    </div>
</x-app-layout>
