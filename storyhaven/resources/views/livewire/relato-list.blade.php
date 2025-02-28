<div>
    {{-- Buscador --}}
    <div class="max-w-lg mb-5">
        <div class="flex">
            <!-- Dropdown de tipo de búsqueda -->
            <select wire:model.live="typeSearch"
                class="shrink-0 z-10 inline-flex items-center py-2.5 px-6 pe-8 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none">
                <option value="titulo">Título</option>
                <option value="generos">Género</option>
                <option value="autor">Autor</option>
            </select>

            <!-- Input de búsqueda -->
            <div class="relative w-full">
                <input type="text" wire:model.live="search"
                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none"
                    placeholder="Buscar..." />
            </div>
        </div>
    </div>
    @if ($relatos->isEmpty())
        <p class="text-gray-500">No hay relatos disponibles.</p>
    @else
        {{-- Tabla de relatos --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-600 dark:bg-gray-700">
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
                            class="text-center bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $relato->titulo }}
                            </td>
                            <td class="inline-flex gap-2 px-6 py-4">
                                @foreach ($relato->generos as $genero)
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-700">
                                        {{ $genero->nombre }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{ $relato->autor->username }}
                            </td>
                            <td class="flex items-center justify-center gap-3 py-4 text-sm">
                                <button wire:click="showRelato({{ $relato->id }})"
                                    class="flex items-center px-3 py-1 text-sm font-semibold text-white transition bg-green-500 rounded hover:bg-green-600 dark:bg-green-700 dark:hover:bg-green-800">
                                    <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Leer relato
                                </button>
                                <button wire:click="deleteRelato({{ $relato->id }})"
                                    class="flex items-center px-3 py-1 text-sm font-semibold text-white transition bg-red-500 rounded hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800">
                                    <svg class="w-5 h-5 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Paginación --}}
        <div class="mt-4" wire:ignore.self>
            {{ $relatos->links() }}
        </div>
    @endif
</div>
