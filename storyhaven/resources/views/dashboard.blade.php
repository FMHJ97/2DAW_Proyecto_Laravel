<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-indigo-900">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <!-- Hero Section -->
    <div class="py-12 bg-gradient-to-br from-indigo-100 via-purple-50 to-amber-50">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="overflow-hidden bg-white border shadow-lg sm:rounded-xl border-amber-200">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-3xl font-bold text-indigo-800">{{ __('Bienvenido a StoryHaven!') }}</h3>
                        <svg class="w-10 h-10 text-amber-500" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z">
                            </path>
                        </svg>
                    </div>

                    <h4 class="mb-3 text-xl italic font-semibold text-indigo-600">Explora, crea y comparte historias
                        inolvidables</h4>

                    <p class="text-lg text-gray-700">StoryHaven es el lugar donde la creatividad cobra vida. Descubre
                        relatos
                        fascinantes, escribe tus propias historias y compártelas con la comunidad.</p>
                </div>
            </div>

            <!-- Featured Sections -->
            <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-3">
                <!-- Card 1: Explorar Relatos -->
                <div
                    class="flex flex-col h-full p-6 transition-all bg-white border-t-4 border-purple-400 rounded-lg shadow-md hover:shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="p-2 mr-4 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-500" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 9a2 2 0 114 0 2 2 0 01-4 0z"></path>
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a4 4 0 00-3.446 6.032l-2.261 2.26a1 1 0 101.414 1.415l2.261-2.261A4 4 0 1011 5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Explorar Relatos</h3>
                    </div>
                    <p class="mb-4 text-gray-600">Descubre historias fascinantes de toda nuestra comunidad de
                        escritores.</p>
                    <div class="mt-auto">
                        <a href="{{ route('relatos.all') }}"
                            class="inline-block w-full px-4 py-2 text-sm font-medium text-center text-white transition-all bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:ring-purple-300">
                            Explorar relatos →
                        </a>
                    </div>
                </div>

                <!-- Card 2: Mis Relatos -->
                <div
                    class="flex flex-col h-full p-6 transition-all bg-white border-t-4 rounded-lg shadow-md border-amber-400 hover:shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="p-2 mr-4 rounded-lg bg-amber-100">
                            <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Mis Relatos</h3>
                    </div>
                    <p class="mb-4 text-gray-600">Accede a todos tus relatos creados. Lee, edita o gestiona tus
                        historias.</p>
                    <div class="mt-auto">
                        <a href="{{ route('relatos.index') }}"
                            class="inline-block w-full px-4 py-2 text-sm font-medium text-center text-white transition-all rounded-lg bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:ring-amber-300">
                            Ver mis relatos →
                        </a>
                    </div>
                </div>

                <!-- Card 3: Crear Nuevo Relato -->
                <div
                    class="flex flex-col h-full p-6 transition-all bg-white border-t-4 border-indigo-400 rounded-lg shadow-md hover:shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="p-2 mr-4 bg-indigo-100 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Crear Nuevo Relato</h3>
                    </div>
                    <p class="mb-4 text-gray-600">¿Tienes una nueva historia en mente? Empieza a escribir y comparte tu
                        creatividad con el mundo.</p>
                    <div class="mt-auto">
                        <a href="{{ route('relatos.create') }}"
                            class="inline-block w-full px-4 py-2 text-sm font-medium text-center text-white transition-all bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300">
                            Crear relato →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
