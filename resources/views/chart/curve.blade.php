@section('title', '歷史報表')
<x-app-layout>

    <x-slot name="scripts"></x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('chart.partials.graph')
                </div>
            </div>
        </div>
    </div>
    <div class="px-6">
        <button class="bg-amber-200 hover:bg-amber-300 text-emerald-700 hover:underline underline-offset-4 font-bold py-2 px-1 border rounded inline-flex items-center">
        <img width="40px" height="40px" src="{{ asset('img/svg/excel_download.svg') }}" class="grid items-center"></img>
        <a href="{{route('export')}}" class="px-2"><span>按此下載所有歷史資料</span>
        </button>
    </div>
</x-app-layout>
