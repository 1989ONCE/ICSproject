@section('title', '新增告警對象')

<x-app-layout>
    
    <x-slot name="scripts"></x-slot>

    <div class="grid justify-items-center xl:flex xl:flex-row overflow-y-auto">
        @include('warn.partials.sidebar')
        <!-- Main content -->
        <main class="pl-8 pr-2 ml-0 xl:ml-[250px] mt-2 w-fit min-w-48 xl:w-[900px] flex flex-col overflow-x-auto place-items-start">
            <div class="flex flex-row gap-0 xl:gap-6">
                <a href="{{route('warning.group')}}">
                    <button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 010 1.06l-6.22 6.22H21a.75.75 0 010 1.5H4.81l6.22 6.22a.75.75 0 11-1.06 1.06l-7.5-7.5a.75.75 0 010-1.06l7.5-7.5a.75.75 0 011.06 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </a>
                @if (session('success'))
                    <div class="ml-2 px-2 h-8 bg-emerald-500 text-white leading-tight rounded-lg grid place-items-center text-sm" role="alert">
                        {{ session('success') }}
                    </div>
                @endif 
                @error('avatar')
                    <div class="ml-2 h-24 bg-rose-100 p-3 rounded-lg break-normal grid place-items-center text-s" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                 @enderror
            </div>
            <div class="flex flex-col xl:flex-row mt-4 gap-10 h-[600px]">
                <div class="w-[400px] flex flex-col px-4">
                    <h2 class="text-xl font-bold leading-tight pb-4">
                        已有人員
                    </h2>
                    @include('warn.partials.card')
                </div>
                <div class="w-[400px] flex flex-col px-4">
                    <h2 class="text-xl font-bold leading-tight pb-4">
                        可新增
                    </h2>
                    @include('warn.partials.card2')
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
