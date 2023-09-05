@section('title', '模型設定')

<x-app-layout>
    
    <x-slot name="scripts"></x-slot>

    <div class="flex flex-col">
        @include('profile.partials.sidebar')
        <!-- Main content -->
        <main class="pr-2 ml-0 xl:ml-[250px] mt-2 w-fit min-w-48 flex flex-col overflow-x-auto items-start">
            <div class="flex flex-row gap-6">
                @if (session('success'))
                    <div class="px-2 h-8 bg-emerald-500 text-white leading-tight rounded-lg grid place-items-center text-sm" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="px-3 h-8 bg-rose-100 rounded-lg break-normal grid place-items-center text-sm" role="alert">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
            </div>
            
            <div class="w-full flex justify-end">
                @include('profile.partials.model-create-form')
            </div>
            <div class="w-11/12 flex flex-row mt-4">
                <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 pr-4 gap-10">
                    @foreach($model as $m)
                        @include('profile.partials.model-setting-card')
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
