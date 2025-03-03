<nav x-data="{ open: false }" class="bg-white border-b border-indigo-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('inicio') }}" class="flex items-center">
                        <x-application-logo class="block w-auto h-10 text-indigo-600 fill-current" />
                        <span class="ml-2 text-xl font-bold text-indigo-800">StoryHaven</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="items-center hidden h-full space-x-4 sm:ms-8 sm:flex">
                    {{-- Enlace a la vista de todos los relatos disponibles --}}
                    <x-nav-link
                        class="inline-flex items-center h-full px-3 mr-0 text-purple-700 hover:text-purple-900 hover:border-purple-400"
                        :href="route('relatos.all')" :active="request()->routeIs('relatos.all')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>{{ __('Explorar') }}</span>
                    </x-nav-link>

                    @auth
                        {{-- Si el usuario es normal --}}
                        @if (Auth::user()->role == 'user')
                            <x-nav-link
                                class="inline-flex items-center h-full px-3 text-yellow-600 hover:text-yellow-800 hover:border-yellow-400"
                                :href="route('relatos.index')" :active="request()->routeIs('relatos.index')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span>{{ __('Mis relatos') }}</span>
                            </x-nav-link>
                            <x-nav-link
                                class="inline-flex items-center h-full px-3 text-indigo-600 hover:text-indigo-800 hover:border-indigo-400"
                                :href="route('relatos.create')" :active="request()->routeIs('relatos.create')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <span>{{ __('Nuevo relato') }}</span>
                            </x-nav-link>
                        @elseif (Auth::user()->role == 'admin')
                            <x-nav-link
                                class="inline-flex items-center h-full px-3 text-orange-600 hover:text-orange-800 hover:border-orange-400"
                                :href="route('admin.usuarios')" :active="request()->routeIs('admin.usuarios')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                {{ __('Administrar usuarios') }}
                            </x-nav-link>
                            <x-nav-link
                                class="inline-flex items-center h-full px-3 text-orange-600 hover:text-orange-800 hover:border-orange-400"
                                :href="route('admin.relatos')" :active="request()->routeIs('admin.relatos')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                {{ __('Administrar relatos') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- Mostramos los enlaces de login y register si el usuario no está autenticado --}}
            @guest
                <div class="items-center hidden h-full space-x-4 sm:flex">
                    <x-nav-link
                        class="inline-flex items-center h-full px-3 text-indigo-700 hover:text-indigo-900 hover:border-indigo-400"
                        :href="route('login')" :active="request()->routeIs('login')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>{{ __('Iniciar sesión') }}</span>
                    </x-nav-link>

                    @if (Route::has('register'))
                        <x-nav-link
                            class="inline-flex items-center h-full px-3 text-purple-600 hover:text-purple-800 hover:border-purple-400"
                            :href="route('register')" :active="request()->routeIs('register')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span>{{ __('Registrarse') }}</span>
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
                                class="flex items-center px-3 py-2 text-sm font-medium leading-4 transition-colors border border-indigo-200 rounded-lg bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                <div class="text-indigo-700">{{ Auth::user()->username }}</div>
                                <div class="ms-1">
                                    <svg class="w-4 h-4 text-indigo-600 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-indigo-500">
                                {{ __('Opciones de usuario') }}
                            </div>
                            <x-dropdown-link class="flex items-center hover:bg-indigo-50" :href="route('profile.edit')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ __('Ver perfil') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link class="flex items-center text-red-600 hover:bg-red-50" :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
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
                    class="inline-flex items-center justify-center p-2 text-indigo-500 transition duration-150 ease-in-out rounded-md hover:bg-indigo-100 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
        <div class="pt-2 pb-3 space-y-1 bg-gradient-to-b from-indigo-50 to-white">
            <x-responsive-nav-link class="flex items-center text-indigo-700" :href="route('relatos.all')" :active="request()->routeIs('relatos.all')">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                {{ __('Explorar') }}
            </x-responsive-nav-link>

            @auth
                @if (Auth::user()->role == 'user')
                    <x-responsive-nav-link class="flex items-center text-amber-600" :href="route('relatos.index')" :active="request()->routeIs('relatos.index')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        {{ __('Mis relatos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link class="flex items-center text-purple-600" :href="route('relatos.create')" :active="request()->routeIs('relatos.create')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        {{ __('Nuevo relato') }}
                    </x-responsive-nav-link>
                @elseif (Auth::user()->role == 'admin')
                    <x-responsive-nav-link class="flex items-center text-amber-600" :href="route('admin.usuarios')" :active="request()->routeIs('admin.usuarios')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        {{ __('Administrar usuarios') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link class="flex items-center text-purple-600" :href="route('admin.relatos')" :active="request()->routeIs('admin.relatos')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        {{ __('Administrar relatos') }}
                    </x-responsive-nav-link>
                @endif

                <div class="pt-4 pb-1 border-t border-indigo-200">
                    <div class="px-4">
                        <div class="text-base font-medium text-indigo-800">{{ Auth::user()->username }}</div>
                        <div class="text-sm font-medium text-indigo-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link class="flex items-center" :href="route('profile.edit')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-indigo-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ __('Ver perfil') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link class="flex items-center text-red-600" :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Cerrar sesión') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @else
                <div class="pt-4 pb-1 mt-3 border-t border-indigo-200">
                    <x-responsive-nav-link
                        class="flex items-center justify-center py-2 mb-2 text-center text-indigo-700 border border-indigo-200 rounded-lg bg-indigo-50"
                        :href="route('login')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        {{ __('Log in') }}
                    </x-responsive-nav-link>

                    @if (Route::has('register'))
                        <x-responsive-nav-link
                            class="flex items-center justify-center py-2 text-center text-white bg-indigo-600 rounded-lg"
                            :href="route('register')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
