<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre y Apellidos -->
        <div class="flex space-x-4">
            <div class="w-1/2">
                <x-input-label for="nombre" :value="__('Nombre')" />
                <x-text-input id="nombre" class="block w-full mt-1" type="text" name="nombre" :value="old('nombre')"
                    required autofocus autocomplete="nombre" />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <div class="w-1/2">
                <x-input-label for="apellidos" :value="__('Apellidos')" />
                <x-text-input id="apellidos" class="block w-full mt-1" type="text" name="apellidos" :value="old('apellidos')"
                    required autofocus autocomplete="apellidos" />
                <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
            </div>
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="mt-4">
            <x-input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')" />
            <x-text-input id="fecha_nacimiento" class="block w-full mt-1" type="date" name="fecha_nacimiento"
                :value="old('fecha_nacimiento')" required autofocus />
            <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
        </div>

        <!-- País -->
        <div class="mt-4">
            <x-input-label for="pais" :value="__('País')" />
            <select id="pais" name="pais" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm"
                autofocus :value="old('pais')" required>
                <option value="" disabled selected>{{ __('Seleccionar país') }}</option>
                <option value="España">{{ __('España') }}</option>
                <option value="Italia">{{ __('Italia') }}</option>
                <option value="Portugal">{{ __('Portugal') }}</option>
                <option value="Inglaterra">{{ __('Inglaterra') }}</option>
                <option value="Francia">{{ __('Francia') }}</option>
            </select>
            <x-input-error :messages="$errors->get('pais')" class="mt-2" />
        </div>

        <!-- Usuario Address -->
        <div class="mt-4">
            <x-input-label for="usuario" :value="__('Usuario')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="usuario" :value="old('usuario')"
                required autocomplete="usuario" />
            <x-input-error :messages="$errors->get('usuario')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('¿Ya tienes una cuenta?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
