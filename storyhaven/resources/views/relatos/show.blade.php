<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-indigo-900">
            {{ __('Detalles del Relato') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-100 via-purple-50 to-amber-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden border shadow-lg bg-slate-50 border-amber-200 sm:rounded-xl">
                <div class="p-6">
                    {{-- Título del relato --}}
                    <h3 class="text-3xl font-bold text-indigo-800">{{ $relato->titulo }}</h3>

                    <div class="flex flex-wrap items-center mt-3 mb-6 text-sm text-gray-600">
                        {{-- Fecha de publicación --}}
                        <div class="flex items-center mr-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-amber-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($relato->fecha_publicacion)->translatedFormat('d \d\e F \d\e Y') }}</span>
                        </div>

                        {{-- Autor del relato --}}
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-indigo-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $relato->autor->name }} {{ $relato->autor->surname }}
                                <span class="text-indigo-600">({{ $relato->autor->username }})</span>
                            </span>
                        </div>
                    </div>

                    {{-- Géneros --}}
                    <div class="mb-6">
                        <h3 class="mb-3 text-sm font-medium text-indigo-700">Géneros:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($relato->generos as $genero)
                                <span
                                    class="px-3 py-1 text-sm font-medium text-purple-800 bg-purple-200 rounded-full">{{ $genero->nombre }}</span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Resumen del relato --}}
                    <div class="p-5 mb-6 bg-white border border-indigo-100 rounded-lg">
                        <h3 class="mb-3 text-lg font-semibold text-indigo-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Resumen
                        </h3>
                        <p class="text-gray-700">{{ $relato->resumen }}</p>
                    </div>

                    {{-- Contenido del relato --}}
                    <div class="p-6 mb-8 bg-white border border-indigo-100 rounded-lg">
                        <h3 class="mb-4 text-lg font-semibold text-indigo-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Historia completa
                        </h3>
                        @if ($relato->contenido_pdf !== null)
                            {{-- Mostramos el PDF del relato --}}
                            <iframe src="{{ asset('storage/relatos/' . $relato->contenido_pdf) }}#toolbar=0"
                                class="w-full h-100"></iframe>
                        @else
                            {{-- Mostramos un mensaje de que no existe contenido --}}
                            <p class="text-gray-700">No se ha encontrado contenido para este relato.</p>
                        @endif
                    </div>

                    {{-- Acciones --}}
                    <div class="flex flex-wrap items-center justify-between p-4 mt-6 border-t border-indigo-200">
                        {{-- Volver a la lista de relatos --}}
                        <a href="{{ route('relatos.all') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-700 border border-indigo-300 rounded-lg bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Volver a Inicio
                        </a>

                        @if ($relato->contenido_pdf !== null)
                            {{-- Botón para descargar el PDF --}}
                            <a href="{{ route('relatos.download', $relato) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Descargar PDF
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
