<x-guest-layout>
    <!-- Icono y título -->
    <div class="max-w-2xl mx-auto">
        <div class="flex flex-col items-center mb-6 text-center">
            <div class="p-3 mb-4 bg-indigo-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-indigo-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-indigo-800">Únete a StoryHaven</h2>
            <p class="mt-2 text-gray-600">Crea una cuenta para compartir tus historias</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Datos personales -->
            <div class="mb-6">
                <h3 class="mb-3 text-sm font-semibold text-indigo-700 uppercase">Datos personales</h3>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <!-- Nombre -->
                    <div>
                        <x-input-label for="name" :value="__('Nombre')" class="text-gray-700" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <x-text-input id="name"
                                class="block w-full py-2 pl-10 pr-3 text-sm border border-indigo-300 rounded-lg"
                                type="text" name="name" :value="old('name')" placeholder="Tu nombre" required
                                autofocus autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- Apellidos -->
                    <div>
                        <x-input-label for="surname" :value="__('Apellidos')" class="text-gray-700" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <x-text-input id="surname"
                                class="block w-full py-2 pl-10 pr-3 text-sm border border-indigo-300 rounded-lg"
                                type="text" name="surname" :value="old('surname')" placeholder="Tus apellidos" required
                                autocomplete="surname" />
                        </div>
                        <x-input-error :messages="$errors->get('surname')" class="mt-1" />
                    </div>

                    <!-- Fecha de Nacimiento -->
                    <div>
                        <x-input-label for="date_birth" :value="__('Fecha de Nacimiento')" class="text-gray-700" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <x-text-input id="date_birth"
                                class="block w-full py-2 pl-10 pr-3 text-sm border border-indigo-300 rounded-lg"
                                type="date" name="date_birth" :value="old('date_birth')" required />
                        </div>
                        <x-input-error :messages="$errors->get('date_birth')" class="mt-1" />
                    </div>

                    <!-- País -->
                    <div>
                        <x-input-label for="country" :value="__('País')" class="text-gray-700" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <select id="country" name="country"
                                class="block w-full py-2 pl-10 pr-3 text-sm border border-indigo-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                                <option value="" disabled selected>{{ __('Seleccionar país') }}</option>
                                <option value="España" {{ old('country') == 'España' ? 'selected' : '' }}>
                                    {{ __('España') }}</option>
                                <option value="Italia" {{ old('country') == 'Italia' ? 'selected' : '' }}>
                                    {{ __('Italia') }}</option>
                                <option value="Portugal" {{ old('country') == 'Portugal' ? 'selected' : '' }}>
                                    {{ __('Portugal') }}</option>
                                <option value="Inglaterra" {{ old('country') == 'Inglaterra' ? 'selected' : '' }}>
                                    {{ __('Inglaterra') }}</option>
                                <option value="Francia" {{ old('country') == 'Francia' ? 'selected' : '' }}>
                                    {{ __('Francia') }}</option>
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('country')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Datos de la cuenta -->
            <div class="mb-6">
                <h3 class="mb-3 text-sm font-semibold text-indigo-700 uppercase">Datos de la cuenta</h3>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <!-- Usuario -->
                    <div>
                        <x-input-label for="username" :value="__('Usuario')" class="text-gray-700" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <x-text-input id="username"
                                class="block w-full py-2 pl-10 pr-3 text-sm border border-indigo-300 rounded-lg"
                                type="text" name="username" :value="old('username')" placeholder="Nombre de usuario"
                                required />
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <x-text-input id="email"
                                class="block w-full py-2 pl-10 pr-3 text-sm border border-indigo-300 rounded-lg"
                                type="email" name="email" :value="old('email')" placeholder="correo@ejemplo.com"
                                required autocomplete="email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-text-input id="password"
                                class="block w-full py-2 pl-10 pr-3 text-sm border border-indigo-300 rounded-lg"
                                type="password" name="password" placeholder="Mínimo 8 caracteres" required
                                autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-gray-700" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <x-text-input id="password_confirmation"
                                class="block w-full py-2 pl-10 pr-3 text-sm border border-indigo-300 rounded-lg"
                                type="password" name="password_confirmation" placeholder="Repetir contraseña"
                                required autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>
                </div>
            </div>

            <div
                class="flex flex-col-reverse items-center justify-between gap-4 pt-4 mt-6 border-t border-gray-200 sm:flex-row">
                <a class="text-sm text-indigo-600 hover:text-indigo-700 hover:underline" href="{{ route('login') }}">
                    {{ __('¿Ya tienes una cuenta? Inicia sesión') }}
                </a>

                <x-primary-button
                    class="flex items-center justify-center gap-2 px-5 py-2.5 w-full sm:w-auto whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    {{ __('Crear cuenta') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
