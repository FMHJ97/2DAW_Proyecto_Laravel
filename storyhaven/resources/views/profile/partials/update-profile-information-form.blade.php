<section>
    <header>
        <p class="mt-1 text-base font-semibold text-gray-600">
            {{ __('Actualiza tu cuenta de perfil y la dirección de correo electrónico.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
            <div class="flex-1">
                <x-input-label for="name" :value="__('Nombre')" class="font-medium text-indigo-800" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <x-text-input id="name" name="name" type="text" class="block w-full pl-10"
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                </div>
                <x-input-error class="mt-1" :messages="$errors->get('name')" />
            </div>

            <div class="flex-1">
                <x-input-label for="surname" :value="__('Apellidos')" class="font-medium text-indigo-800" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <x-text-input id="surname" name="surname" type="text" class="block w-full pl-10"
                        :value="old('surname', $user->surname)" required autocomplete="surname" />
                </div>
                <x-input-error class="mt-1" :messages="$errors->get('surname')" />
            </div>
        </div>

        <!-- Fecha de Nacimiento y País -->
        <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
            <div class="w-full md:w-1/2">
                <x-input-label for="date_birth" :value="__('Fecha de Nacimiento')" class="font-medium text-indigo-800" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <x-text-input id="date_birth" class="block w-full pl-10" type="date" name="date_birth"
                        :value="old('date_birth', $user->date_birth)" required />
                </div>
                <x-input-error :messages="$errors->get('date_birth')" class="mt-1" />
            </div>

            <div class="w-full md:w-1/2">
                <x-input-label for="country" :value="__('País')" class="font-medium text-indigo-800" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z" />
                        </svg>
                    </div>
                    <select id="country" name="country"
                        class="block w-full pl-10 border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                        <option value="" disabled>{{ __('Seleccionar país') }}</option>
                        <option value="España" {{ old('country', $user->country) == 'España' ? 'selected' : '' }}>
                            {{ __('España') }}</option>
                        <option value="Italia" {{ old('country', $user->country) == 'Italia' ? 'selected' : '' }}>
                            {{ __('Italia') }}</option>
                        <option value="Portugal" {{ old('country', $user->country) == 'Portugal' ? 'selected' : '' }}>
                            {{ __('Portugal') }}</option>
                        <option value="Inglaterra"
                            {{ old('country', $user->country) == 'Inglaterra' ? 'selected' : '' }}>
                            {{ __('Inglaterra') }}</option>
                        <option value="Francia" {{ old('country', $user->country) == 'Francia' ? 'selected' : '' }}>
                            {{ __('Francia') }}</option>
                    </select>
                </div>
                <x-input-error :messages="$errors->get('country')" class="mt-1" />
            </div>
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Nombre de usuario')" class="font-medium text-indigo-800" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <x-text-input id="username" name="username" type="text" class="block w-full pl-10"
                    :value="old('username', $user->username)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-1" :messages="$errors->get('username')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="font-medium text-indigo-800" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <x-text-input id="email" name="email" type="email" class="block w-full pl-10"
                    :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-1" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="p-2 mt-2 border rounded bg-amber-50 border-amber-200">
                    <p class="flex items-center text-sm text-amber-800">
                        <svg class="w-4 h-4 mr-1.5 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ __('Tu dirección de email no está verificada.') }}

                        <button form="send-verification"
                            class="ml-1 text-sm text-indigo-600 underline hover:text-indigo-900 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500">
                            {{ __('Haz clic aquí para reenviar el email de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1.5 text-sm font-medium text-green-600">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end gap-4 pt-3 mt-6 border-t border-gray-200">
            @if (session('status') === 'password-updated')
                <p class="flex items-center text-sm text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('Datos guardados') }}
                </p>
            @endif

            <x-primary-button class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
</section>
