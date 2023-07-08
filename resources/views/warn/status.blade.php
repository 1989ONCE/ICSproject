@section('title', '斷電斷訊紀錄表')
<x-app-layout>

    <x-slot name="scripts"></x-slot>

    <div class="flex">
        @include('warn.partials.sidebar')
        <!-- Main content -->
        <main class="container mx-[250px] mt-2 w-[650px]">
            <div class="max-w-4xl px-4 pt-2 mx-auto sm:px-8">
                <span class="text-3xl font-bold leading-tight">斷電斷訊紀錄表</span>
                <a href="{{route('power')}}">
                    <span class="text-md px-2 underline underline-offset-4 hover:text-cyan-600 hover:bg-gray-100 hover:font-bold hover:rounded-full hover:p-2">下載斷電斷訊紀錄表</span>
                </a>
            </div>

            <div class="max-w-4xl px-4 mx-auto sm:px-8 grid content-center pt-4">
                @include('warn.partials.table')
            </div>
        </main>
    </div>
</x-app-layout>