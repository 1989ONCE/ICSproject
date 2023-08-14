@section('title', '斷電斷訊紀錄表')
<x-app-layout>

    <x-slot name="scripts"></x-slot>

    <div class="flex flex-row">
        @include('warn.partials.sidebar')
        <!-- Main content -->
        <main class="mx-[250px] mt-10 w-9/12">
        <div class="container mx-auto py-8">
			<span class="text-2xl font-bold mb-6 text-start">斷電斷訊紀錄表</span>
        </div>

        <div class="w-fit">
            @include('warn.partials.table')
        <div>
        </main>
    </div>
</x-app-layout>