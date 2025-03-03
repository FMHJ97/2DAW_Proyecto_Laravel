<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-indigo-900">
            {{ __('Explorar Relatos') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-100 via-purple-50 to-amber-50">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border shadow-lg sm:rounded-xl border-amber-200">
                <div class="p-6">
                    @livewire('relatos-all')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
