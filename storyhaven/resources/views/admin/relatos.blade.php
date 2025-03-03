<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-indigo-900">
            {{ __('Administrar relatos') }}
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
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Listado de relatos publicados
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Gestiona todos los relatos de la plataforma, elimina o restaura publicaciones
                                cuando sea necesario.
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
                        @livewire('relato-list')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
