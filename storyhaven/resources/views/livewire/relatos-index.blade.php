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
                </select>

                <!-- Input de búsqueda -->
                <div class="relative w-full">
                    <input type="text" wire:model.live="search"
                        class="block w-full p-2.5 text-sm rounded-r-lg border-l-0 bg-white border border-indigo-300 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Buscar en mis relatos..." />
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

    {{-- Mostramos todos los posibles relatos que tenga el usuario --}}
    @if ($relatos->isNotEmpty())
        {{-- Mostramos los relatos en una cuadrícula --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {{-- Recorremos cada relato y mostramos sus campos --}}
            @foreach ($relatos as $relato)
                <div
                    class="flex flex-col h-full overflow-hidden transition-all border-t-4 border-indigo-400 rounded-lg shadow-sm bg-slate-50 hover:shadow-md">
                    <div class="p-5">
                        {{-- Título del relato --}}
                        <h3 class="mb-2 text-xl font-bold text-indigo-800">{{ $relato->titulo }}</h3>

                        {{-- Fecha de publicación del relato --}}
                        <div class="flex items-center mb-3 space-x-2 text-sm text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-indigo-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($relato->fecha_publicacion)->translatedFormat('d \d\e F \d\e Y') }}</span>
                        </div>

                        {{-- Géneros del relato. Mostramos cada relato como una pill --}}
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach ($relato->generos as $genero)
                                <span class="px-2 py-1 text-xs font-medium text-purple-800 bg-purple-200 rounded-full">
                                    {{ $genero->nombre }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Mostramos el resumen del relato --}}
                        <p class="mb-4 text-gray-700 line-clamp-3">{{ $relato->resumen }}</p>
                    </div>

                    {{-- Botones de acción --}}
                    <div class="px-5 py-3 mt-auto border-t border-indigo-200 bg-indigo-50">
                        <div class="flex justify-between">
                            {{-- Enlace para ver el relato completo --}}
                            <a href="{{ route('relatos.show', $relato) }}"
                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Leer
                            </a>

                            {{-- Enlace para editar el relato --}}
                            <a href="{{ route('relatos.edit', $relato) }}"
                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-amber-600 rounded-lg hover:bg-amber-700 focus:ring-2 focus:ring-amber-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Editar
                            </a>

                            {{-- Botón para eliminar el relato --}}
                            <button wire:click="confirmRelatoDeletion({{ $relato->id }})"
                                class="flex items-center px-3 py-1.5 text-sm font-medium text-white transition bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-8 text-center rounded-lg bg-indigo-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 text-indigo-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <p class="text-lg font-medium text-indigo-700">No tienes relatos creados.</p>
            <p class="mt-2 text-gray-600">¿Por qué no comienzas escribiendo una nueva historia?</p>
            <a href="{{ route('relatos.create') }}"
                class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Crear nuevo relato
            </a>
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

    <!-- Modal de confirmación de eliminación de relato -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <!-- Overlay de fondo oscuro -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

            <!-- Contenedor del modal centrado -->
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Contenido del modal -->
                <div
                    class="relative inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="p-6">
                        <div class="mb-6 text-center">
                            <div class="p-3 mx-auto bg-red-100 rounded-full w-fit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>

                        <h2 class="text-xl font-semibold text-center text-red-700">
                            {{ __('¿Estás seguro de que quieres eliminar este relato?') }}
                        </h2>

                        <p class="mt-3 text-sm text-center text-gray-600">
                            {{ __('Esta acción eliminará el relato "') }}{{ $relatoToDelete->titulo }}{{ __('" de forma inmediata. Sin embargo, podrá restaurar dicho relato si contacta con algún administrador del sitio web.') }}
                        </p>

                        <div class="flex justify-end gap-3 pt-3 mt-6 border-t border-gray-200">
                            <button wire:click="cancelRelatoDeletion" type="button"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                {{ __('Cancelar') }}
                            </button>

                            <button wire:click="deleteConfirmed" type="button"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                {{ __('Eliminar relato') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
