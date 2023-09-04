@section('title', '斷電斷訊紀錄表')
<x-app-layout>

    <x-slot name="scripts"></x-slot>

    <div class="grid justify-items-center xl:flex xl:flex-row">
        @include('warn.partials.sidebar')
        <!-- Main content -->
        <main class="pl-4 pr-2 ml-0 xl:ml-[250px] mt-2 min-w-48 xl:w-[900px] flex flex-col overflow-x-auto items-start">
            <div class="container max-w-4xl">
                <span class="text-3xl font-bold leading-tight">斷電斷訊紀錄表</span>
                <a href="{{route('power')}}">
                    <span class="text-md px-2 underline underline-offset-4 hover:text-cyan-600 hover:bg-gray-100 hover:font-bold hover:rounded-full hover:p-2">下載斷電斷訊紀錄表</span>
                </a>
            </div>

            <div class="w-full max-w-4xl px-4 mx-auto sm:px-8 grid content-center pt-4">
                @include('warn.partials.table')
            </div>
        </main>
    </div>
</x-app-layout>