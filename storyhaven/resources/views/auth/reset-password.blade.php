<x-guest-layout>
    <div class="max-w-md p-6 mx-auto">
        <!-- Icono y título -->
        <div class="flex flex-col items-center mb-6 text-center">
            <div class="p-3 mb-4 bg-indigo-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-indigo-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-indigo-800">Restablecer contraseña</h2>
            <p class="mt-2 text-gray-600">Crea una nueva contraseña para tu cuenta</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email')" class="font-medium text-gray-700" />
                <div class="relative mt-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <x-text-input id="email"
                        class="block w-full pl-10 pr-3 py-2.5 text-sm border border-indigo-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-gray-100"
                        type="email" name="email" :value="old('email', $request->email)" required autocomplete="email" readonly />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <x-input-label for="password" :value="__('Nueva contraseña')" class="font-medium text-gray-700" />
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
                        type="password" name="password" placeholder="Mínimo 8 caracteres" required autofocus
                        autocomplete="new-password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="font-medium text-gray-700" />
                <div class="relative mt-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <x-text-input id="password_confirmation"
                        class="block w-full pl-10 pr-3 py-2.5 text-sm border border-indigo-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        type="password" name="password_confirmation" placeholder="Repetir contraseña" required
                        autocomplete="new-password" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex flex-col items-center justify-between gap-4 pt-4 mt-6 border-t border-gray-200">
                <x-primary-button class="flex items-center justify-center gap-2 py-2.5 px-5 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('Restablecer contraseña') }}
                </x-primary-button>

                <a href="{{ route('login') }}"
                    class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline whitespace-nowrap">
                    ← Volver a iniciar sesión
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
