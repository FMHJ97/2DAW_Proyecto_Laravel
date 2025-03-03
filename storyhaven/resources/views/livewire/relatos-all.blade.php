<div>
    {{-- Buscador --}}
    <div class="mb-6">
        <div class="flex flex-col space-y-4 md:flex-row md:items-center md:justify-between md:space-y-0 md:space-x-4">
            <div class="flex w-full md:w-1/3">
                <!-- Dropdown de tipo de búsqueda -->
                <select wire:model.live="typeSearch"
                    class="z-10 ps-4 pe-8 py-2.5 text-sm font-medium rounded-l-lg text-indigo-700 bg-indigo-50 border border-indigo-300 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="titulo">Título</option>
                    <option value="generos">Género</option>
                    <option value="autor">Autor</option>
                </select>

                <!-- Input de búsqueda - AHORA MÁS LARGO -->
                <div class="relative w-full">
                    <input type="text" wire:model.live="search"
                        class="block w-full p-2.5 text-sm rounded-r-lg border-l-0 bg-white border border-indigo-300 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Buscar relatos..." />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mostramos todos los relatos disponibles --}}
    @if ($relatos->isNotEmpty())
        {{-- Mostramos los relatos en una cuadrícula --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
            {{-- Recorremos cada relato y mostramos sus campos --}}
            @foreach ($relatos as $relato)
                <div
                    class="flex flex-col h-full overflow-hidden transition-all border-t-4 border-indigo-400 rounded-lg shadow-sm bg-slate-50 hover:shadow-md">
                    <div class="p-5">
                        {{-- Título del relato --}}
                        <h3 class="mb-2 text-xl font-bold text-indigo-800">{{ $relato->titulo }}</h3>

                        {{-- Info del autor y fecha --}}
                        <div class="flex items-center mb-3 space-x-2 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-indigo-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ $relato->autor->username }}</span>
                            </div>
                            <span>•</span>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-amber-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($relato->fecha_publicacion)->translatedFormat('d \d\e F \d\e Y') }}</span>
                            </div>
                        </div>

                        {{-- Géneros del relato --}}
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach ($relato->generos as $genero)
                                <span class="px-2 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-full">
                                    {{ $genero->nombre }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Mostramos el resumen del relato --}}
                        <p class="mb-4 text-gray-600 line-clamp-3">{{ $relato->resumen }}</p>
                    </div>

                    {{-- Enlace para ver el relato completo --}}
                    <div class="px-5 py-3 mt-auto border-t border-indigo-100 bg-indigo-50">
                        <a href="{{ route('relatos.show', $relato) }}"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Leer relato
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-8 text-center rounded-lg bg-indigo-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 text-indigo-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <p class="text-lg font-medium text-indigo-700">No hay relatos disponibles con tu búsqueda.</p>
            <p class="mt-2 text-gray-600">Intenta con otros términos o explora todas las historias.</p>
        </div>
    @endif

    {{-- Paginación de los relatos con estilo personalizado --}}
    <div class="mt-6" wire:ignore.self>
        <div class="pagination-custom">
            @if ($relatos->hasPages())
                <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                    {{-- Links para pantallas pequeñas --}}
                    <div class="flex justify-between flex-1 sm:hidden">
                        @if ($relatos->onFirstPage())
                            <span
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-default">
                                Anterior
                            </span>
                        @else
                            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-700 bg-white border border-indigo-300 rounded-md hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Anterior
                            </button>
                        @endif

                        @if ($relatos->hasMorePages())
                            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-indigo-700 bg-white border border-indigo-300 rounded-md hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Siguiente
                            </button>
                        @else
                            <span
                                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-default">
                                Siguiente
                            </span>
                        @endif
                    </div>

                    {{-- Links para pantallas medianas+ --}}
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
                        <div>
                            <span class="relative z-0 inline-flex rounded-md shadow-sm">
                                {{-- Botón Anterior --}}
                                @if ($relatos->onFirstPage())
                                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                        <span
                                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 cursor-default rounded-l-md"
                                            aria-hidden="true">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </span>
                                @else
                                    <button wire:click="previousPage" rel="prev"
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-indigo-600 bg-white border border-indigo-300 rounded-l-md hover:bg-indigo-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                @endif

                                {{-- Páginas numeradas --}}
                                @foreach ($relatos->getUrlRange(max(1, $relatos->currentPage() - 2), min($relatos->lastPage(), $relatos->currentPage() + 2)) as $page => $url)
                                    @if ($page == $relatos->currentPage())
                                        <span aria-current="page">
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-indigo-600 border border-indigo-600 cursor-default">{{ $page }}</span>
                                        </span>
                                    @else
                                        <button wire:click="gotoPage({{ $page }})"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-indigo-600 bg-white border border-indigo-300 hover:bg-indigo-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                            {{ $page }}
                                        </button>
                                    @endif
                                @endforeach

                                {{-- Botón Siguiente --}}
                                @if ($relatos->hasMorePages())
                                    <button wire:click="nextPage" rel="next"
                                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-indigo-600 bg-white border border-indigo-300 rounded-r-md hover:bg-indigo-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                @else
                                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                        <span
                                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-300 bg-white border border-gray-300 cursor-default rounded-r-md"
                                            aria-hidden="true">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </span>
                                @endif
                            </span>
                        </div>
                    </div>
                </nav>
            @endif
        </div>
    </div>
</div>
