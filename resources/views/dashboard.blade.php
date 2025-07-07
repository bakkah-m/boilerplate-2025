<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-base-100 overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 text-base-content">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
