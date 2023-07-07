@section('title', '斷電斷訊紀錄表')
<x-app-layout>

    <x-slot name="scripts"></x-slot>

    <div class="flex flex-row">
        @include('warn.partials.sidebar')
        <!-- Main content -->
        <main class="mx-[250px] mt-2 w-9/12">
            <div class="container mx-auto pt-2 pb-4 px-4">
                <span class="text-3xl font-bold leading-tight">斷電斷訊紀錄表</span>
                <a href="{{route('power')}}">
                    <span class="text-md px-2 underline underline-offset-4 hover:text-cyan-600 hover:bg-gray-100 hover:font-bold hover:rounded-full hover:p-2">下載斷電斷訊紀錄表</span>
                </a>
            </div>

            <div class="w-fit px-4">
                @include('warn.partials.table')
            </div>
        </main>
    </div>
</x-app-layout>