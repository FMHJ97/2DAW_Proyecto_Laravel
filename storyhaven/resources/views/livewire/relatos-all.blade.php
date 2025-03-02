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
    {{-- Mostramos todos los relatos disponibles --}}
    @if ($relatos->isNotEmpty())
        {{-- Mostramos los relatos en una cuadrícula --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            {{-- Recorremos cada relato y mostramos sus campos --}}
            @foreach ($relatos as $relato)
                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                    {{-- Título del relato --}}
                    <h3 class="text-xl font-semibold text-gray-800">{{ $relato->titulo }}</h3>
                    {{-- Nombre del autor del relato --}}
                    <p class="text-gray-500">
                        <strong>Autor:</strong> {{ $relato->autor->username }}
                    </p>
                    {{-- Fecha de publicación del relato --}}
                    <p class="text-gray-500">
                        {{ \Carbon\Carbon::parse($relato->fecha_publicacion)->translatedFormat('d \d\e F \d\e Y') }}
                    </p>
                    {{-- Géneros del relato. Mostramos cada género como una pill --}}
                    <div class="flex flex-wrap mt-2">
                        @foreach ($relato->generos as $genero)
                            <span
                                class="px-2 py-1 mr-2 text-sm text-white bg-blue-500 rounded-full">{{ $genero->nombre }}</span>
                        @endforeach
                    </div>
                    {{-- Mostramos el resumen del relato --}}
                    <p class="mt-2 text-gray-500">{{ $relato->resumen }}</p>
                    {{-- Enlace para ver el relato completo --}}
                    <div class="mt-4">
                        <a href="{{ route('relatos.show', $relato) }}" class="text-blue-500 hover:text-blue-700">Ver
                            relato</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No hay relatos disponibles.</p>
    @endif
    {{-- Paginación de los relatos --}}
    <div class="mt-4">
        {{ $relatos->links() }}
    </div>
</div>
