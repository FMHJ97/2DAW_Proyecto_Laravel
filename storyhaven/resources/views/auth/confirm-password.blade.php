<x-guest-layout>
    <div class="max-w-md p-6 mx-auto">
        <!-- Icono y título -->
        <div class="flex flex-col items-center mb-6 text-center">
            <div class="p-3 mb-4 bg-indigo-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-indigo-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-indigo-800">Área segura</h2>
        </div>

        <div class="p-4 mb-6 text-sm text-center text-gray-700 border border-blue-100 rounded-lg bg-blue-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto mb-2 text-blue-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ __('Estás accediendo a un área segura de StoryHaven. Por favor, confirma tu contraseña antes de continuar.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-6">
                <x-input-label for="password" :value="__('Contraseña')" class="font-medium text-gray-700" />
                <div class="relative mt-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-text-input id="password"
                        class="block w-full pl-10 pr-3 py-2.5 text-sm border border-indigo-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        type="password" name="password" placeholder="Introduce tu contraseña" required
                        autocomplete="current-password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end pt-3 mt-4 border-t border-gray-200">
                <x-primary-button class="flex items-center justify-center gap-2 px-5 py-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('Confirmar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
