<div>
    {{-- Buscador y filtro de eliminados en la misma línea --}}
    <div class="flex items-center justify-between mb-6">
        {{-- Buscador (1/3 del ancho) --}}
        <div class="flex w-1/3">
            <!-- Dropdown de tipo de búsqueda -->
            <select wire:model.live="typeSearch"
                class="z-10 ps-4 pe-8 py-2.5 text-sm font-medium rounded-l-lg text-indigo-700 bg-indigo-50 border border-indigo-300 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="titulo">Título</option>
                <option value="generos">Género</option>
                <option value="autor">Autor</option>
            </select>

            <!-- Input de búsqueda -->
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

        {{-- Selector de tipo de vista (activos/eliminados) --}}
        <div class="flex items-center justify-end">
            <div class="inline-flex items-center p-2 border border-indigo-200 rounded-lg bg-indigo-50">
                <input id="filter-deleted" type="checkbox" wire:model.live="includeDeleted" wire:click="resetPage"
                    class="w-4 h-4 bg-gray-100 rounded text-amber-600 border-amber-300 focus:ring-amber-500">
                <label for="filter-deleted" class="flex items-center ml-2 text-sm font-medium text-amber-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Mostrar solo relatos eliminados
                </label>
            </div>
        </div>
    </div>

    @if ($relatos->isEmpty())
        <div class="p-8 text-center rounded-lg bg-indigo-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 text-indigo-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <p class="text-lg font-medium text-indigo-700">No hay relatos disponibles</p>
            <p class="mt-2 text-gray-600">
                {{ $includeDeleted ? 'No hay relatos eliminados en este momento.' : 'No se encontraron relatos que coincidan con los criterios de búsqueda.' }}
            </p>
        </div>
    @else
        {{-- Tabla de relatos --}}
        <div class="relative overflow-x-auto border border-indigo-200 rounded-lg shadow-sm">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-white uppercase bg-indigo-600">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            Título
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Géneros
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Autor
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($relatos as $relato)
                        <tr wire:key='relato-{{ $relato->id }}'
                            class="text-center bg-white border-b border-indigo-100 hover:bg-slate-50 {{ $relato->deleted_at ? 'bg-red-50' : '' }}">
                            <td scope="row" class="px-6 py-4 font-medium text-indigo-800 whitespace-nowrap">
                                {{ $relato->titulo }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap justify-center gap-2">
                                    @foreach ($relato->generos as $genero)
                                        <span
                                            class="px-2 py-1 text-xs font-medium text-purple-800 bg-purple-200 rounded-full">
                                            {{ $genero->nombre }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-indigo-600">{{ $relato->autor->username }}</span>
                            </td>
                            <td class="flex items-center justify-center gap-3 py-4 text-sm">
                                @if ($relato->deleted_at)
                                    {{-- Si el relato está eliminado, solo botón de restaurar --}}
                                    <button wire:click="restoreRelato({{ $relato->id }})"
                                        class="flex items-center px-3 py-1.5 text-sm font-medium text-white bg-amber-500 rounded-lg hover:bg-amber-600 focus:ring-2 focus:ring-amber-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Restaurar
                                    </button>
                                @else
                                    {{-- Si el relato está activo, mostrar botones de ver y eliminar --}}
                                    <a href="{{ route('relatos.show', $relato->id) }}"
                                        class="flex items-center px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Ver
                                    </a>
                                    <button wire:click="confirmRelatoDeletion({{ $relato->id }})"
                                        class="flex items-center px-3 py-1.5 text-sm font-medium text-white transition bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Eliminar
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación con estilo personalizado --}}
        <div class="mt-6" wire:ignore.self>
            <div class="pagination-custom">
                @if ($relatos->hasPages())
                    <nav role="navigation" aria-label="Pagination Navigation"
                        class="flex items-center justify-between">
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
    @endif

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
                            {{ __('Esta acción eliminará el relato "') }}{{ $relatoToDelete->titulo }}{{ __('" de forma inmediata. Sin embargo, podrá restaurar dicho relato cuando lo vea oportuno.') }}
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
