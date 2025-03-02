<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Mis relatos') }}
        </h2>
        {{-- Si se ha creado un relato correctamente, se mostrará un mensaje --}}
        @if (session('success'))
            <div class="mt-4 text-green-500">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="mt-4 text-red-500">{{ session('error') }}</div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @livewire('relatos-index')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
