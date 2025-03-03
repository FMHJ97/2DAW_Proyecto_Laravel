<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-indigo-900">
            {{ __('Administrar usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-100 via-purple-50 to-amber-50">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden border shadow-lg bg-slate-50 border-amber-200 sm:rounded-xl">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="flex items-center text-lg font-semibold text-indigo-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Listado de usuarios registrados
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Gestiona los usuarios de la plataforma, cambia roles o elimina cuentas cuando sea
                                necesario.
                            </p>
                        </div>

                        <div class="hidden sm:block">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-md bg-indigo-100 text-indigo-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium">Acceso restringido a administradores</span>
                            </span>
                        </div>
                    </div>

                    <div class="p-4 bg-white border border-indigo-100 rounded-lg shadow-sm sm:p-6">
                        {{-- Cargamos el componente livewire --}}
                        @livewire('user-list')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
