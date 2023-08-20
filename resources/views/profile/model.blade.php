@section('title', '模型設定')

<x-app-layout>
    
    <x-slot name="scripts"></x-slot>

    <div class="flex">
        @include('profile.partials.sidebar')
        <!-- Main content -->
        <main class="ml-[250px] mt-8 w-9/12">
            <div class="flex flex-row gap-6">
                @if (session('success'))
                    <div class="px-2 h-8 bg-emerald-500 text-white leading-tight rounded-lg grid place-items-center text-sm" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="px-3 h-8 bg-rose-100 rounded-lg break-normal grid place-items-center text-s" role="alert">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
            </div>
            <div class="w-11/12 flex flex-row mt-4">
                <div class="w-full grid grid-cols-3 px-4 gap-10">
                    @foreach($model as $m)
                        @include('profile.partials.model-setting-card')
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
