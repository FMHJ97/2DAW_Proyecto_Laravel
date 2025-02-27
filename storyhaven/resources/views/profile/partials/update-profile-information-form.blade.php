<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del usuario') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Actualiza tu cuenta de perfil y la dirección de correo electrónico.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="flex space-x-4">
            <div class="flex-1">
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="flex-1">
                <x-input-label for="surname" :value="__('Apellidos')" />
                <x-text-input id="surname" name="surname" type="text" class="block w-full mt-1" :value="old('surname', $user->surname)"
                    required autocomplete="surname" />
                <x-input-error class="mt-2" :messages="$errors->get('surname')" />
            </div>
        </div>

        <!-- Fecha de Nacimiento y País -->
        <div class="flex mt-4 space-x-4">
            <div class="w-1/2">
                <x-input-label for="date_birth" :value="__('Fecha de Nacimiento (mm/dd/yyyy)')" />
                <x-text-input id="date_birth" class="block w-full mt-1" type="date" name="date_birth"
                    :value="old('date_birth', $user->date_birth)" required />
                <x-input-error :messages="$errors->get('date_birth')" class="mt-2" />
            </div>

            <div class="w-1/2">
                <x-input-label for="country" :value="__('País')" />
                <select id="country" name="country" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm"
                    required>
                    <option value="" disabled>{{ __('Seleccionar país') }}</option>
                    <option value="España" {{ old('country', $user->country) == 'España' ? 'selected' : '' }}>
                        {{ __('España') }}</option>
                    <option value="Italia" {{ old('country', $user->country) == 'Italia' ? 'selected' : '' }}>
                        {{ __('Italia') }}</option>
                    <option value="Portugal" {{ old('country', $user->country) == 'Portugal' ? 'selected' : '' }}>
                        {{ __('Portugal') }}</option>
                    <option value="Inglaterra" {{ old('country', $user->country) == 'Inglaterra' ? 'selected' : '' }}>
                        {{ __('Inglaterra') }}</option>
                    <option value="Francia" {{ old('country', $user->country) == 'Francia' ? 'selected' : '' }}>
                        {{ __('Francia') }}</option>
                </select>
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Cambios guardados.') }}</p>
            @endif
        </div>
    </form>
</section>
