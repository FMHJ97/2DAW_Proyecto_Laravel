<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-indigo-900">
            {{ __('Mi perfil') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-100 via-purple-50 to-amber-50">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- Fila con dos columnas (perfil e información) --}}
            <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2 lg:gap-8">
                {{-- Actualizar información de perfil --}}
                <div class="overflow-hidden border border-indigo-200 shadow-lg bg-slate-50 sm:rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="p-2 mr-3 bg-indigo-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-indigo-800">Información personal</h3>
                        </div>
                        <div class="p-5 bg-white border border-indigo-100 rounded-lg">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                {{-- Actualizar contraseña --}}
                <div class="overflow-hidden border border-indigo-200 shadow-lg bg-slate-50 sm:rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="p-2 mr-3 bg-indigo-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-indigo-800">Seguridad de la cuenta</h3>
                        </div>
                        <div class="p-5 bg-white border border-indigo-100 rounded-lg">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>

            {{-- Eliminar cuenta (fila separada) --}}
            <div class="overflow-hidden border border-red-200 shadow-lg bg-slate-50 sm:rounded-xl">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-2 mr-3 bg-red-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-red-700">Eliminar cuenta</h3>
                    </div>
                    <div class="p-5 bg-white border border-red-100 rounded-lg">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
