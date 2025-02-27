<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre y Apellidos -->
        <div class="flex space-x-4">
            <div class="w-1/2">
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="w-1/2">
                <x-input-label for="surname" :value="__('Apellidos')" />
                <x-text-input id="surname" class="block w-full mt-1" type="text" name="surname" :value="old('surname')"
                    required autocomplete="surname" />
                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
            </div>
        </div>

        <!-- Fecha de Nacimiento y País -->
        <div class="flex mt-4 space-x-4">
            <div class="w-1/2">
                <x-input-label for="date_birth" :value="__('Fecha de Nacimiento')" />
                <x-text-input id="date_birth" class="block w-full mt-1" type="date" name="date_birth"
                    :value="old('date_birth')" required />
                <x-input-error :messages="$errors->get('date_birth')" class="mt-2" />
            </div>

            <div class="w-1/2">
                <x-input-label for="country" :value="__('País')" />
                <select id="country" name="country" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm"
                    :value="old('country')" required>
                    <option value="" disabled selected>{{ __('Seleccionar país') }}</option>
                    <option value="España">{{ __('España') }}</option>
                    <option value="Italia">{{ __('Italia') }}</option>
                    <option value="Portugal">{{ __('Portugal') }}</option>
                    <option value="Inglaterra">{{ __('Inglaterra') }}</option>
                    <option value="Francia">{{ __('Francia') }}</option>
                </select>
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña y Confirmar Contraseña -->
        <div class="flex mt-4 space-x-4">
            <div class="w-1/2">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="w-1/2">
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
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
