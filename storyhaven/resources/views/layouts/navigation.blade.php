<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('inicio') }}">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Enlace a la vista de todos los relatos disponibles --}}
                    <x-nav-link class="mr-0" :href="route('relatos.all')" :active="request()->routeIs('relatos.all')">
                        {{ __('Explorar') }}
                    </x-nav-link>

                    @auth
                        {{-- Si el usuario es normal --}}
                        @if (Auth::user()->role == 'user')
                            <x-nav-link :href="route('relatos.index')" :active="request()->routeIs('relatos.index')">
                                {{ __('Mis relatos') }}
                            </x-nav-link>
                            <x-nav-link :href="route('relatos.create')" :active="request()->routeIs('relatos.create')">
                                {{ __('Nuevo relato') }}
                            </x-nav-link>
                        @elseif (Auth::user()->role == 'admin')
                            <x-nav-link :href="route('admin.usuarios')" :active="request()->routeIs('admin.usuarios')">
                                {{ __('Administrar usuarios') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.relatos')" :active="request()->routeIs('admin.relatos')">
                                {{ __('Administrar relatos') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- Mostramos los enlaces de login y register si el usuario no está autenticado --}}
            @guest
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('login')">
                        {{ __('Log in') }}
                    </x-nav-link>

                    @if (Route::has('register'))
                        <x-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    @endif
                </div>
            @endguest

            @auth
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                <div>{{ Auth::user()->username }}</div>
                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Ver perfil') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Hamburger Menu -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('relatos.all')" :active="request()->routeIs('relatos.all')">
                {{ __('Explorar') }}
            </x-responsive-nav-link>

            @auth
                @if (Auth::user()->role == 'user')
                    <x-responsive-nav-link :href="route('relatos.index')" :active="request()->routeIs('relatos.index')">
                        {{ __('Mis relatos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('relatos.create')" :active="request()->routeIs('relatos.create')">
                        {{ __('Nuevo relato') }}
                    </x-responsive-nav-link>
                @elseif (Auth::user()->role == 'admin')
                    <x-responsive-nav-link :href="route('admin.usuarios')" :active="request()->routeIs('admin.usuarios')">
                        {{ __('Administrar usuarios') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.relatos')" :active="request()->routeIs('admin.relatos')">
                        {{ __('Administrar relatos') }}
                    </x-responsive-nav-link>
                @endif
            @endauth

            @guest
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Log in') }}
                </x-responsive-nav-link>

                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endif
            @endguest
        </div>
    </div>
</nav>
