<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Warning') }}
        </h2>
    </x-slot>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Warning Group</h3>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>