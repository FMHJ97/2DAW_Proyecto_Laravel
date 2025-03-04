<x-guest-layout>
    <div class="max-w-md p-6 mx-auto">
        <!-- Icono y título -->
        <div class="flex flex-col items-center mb-6 text-center">
            <div class="p-3 mb-4 bg-indigo-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-indigo-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-indigo-800">Recuperar contraseña</h2>
        </div>

        <!-- Mensaje explicativo -->
        <div class="mb-6 text-center text-gray-600">
            <p>{{ __('¿Olvidaste tu contraseña? No te preocupes. Simplemente indícanos tu dirección de correo electrónico y te enviaremos un enlace para crear una nueva.') }}
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="p-4 mb-6 border border-green-200 rounded-lg bg-green-50">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-700">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Correo electrónico')" class="font-medium text-gray-700" />
                <div class="relative mt-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <x-text-input id="email"
                        class="block w-full pl-10 pr-3 py-2.5 text-sm border border-indigo-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        type="email" name="email" :value="old('email')" placeholder="nombre@ejemplo.com" required
                        autofocus />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-center sm:space-y-0">
                <x-primary-button class="flex items-center justify-center gap-2 py-2.5 px-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    {{ __('Enviar enlace de recuperación') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
