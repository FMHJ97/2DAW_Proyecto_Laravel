<div>
    {{-- Mostramos todos los posibles relatos que tenga el usuario --}}
    @if ($relatos->isNotEmpty())
        {{-- Mostramos los relatos en una cuadrícula --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            {{-- Recorremos cada relato y mostramos sus campos --}}
            @foreach ($relatos as $relato)
                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                    {{-- Título del relato --}}
                    <h3 class="text-xl font-semibold text-gray-800">{{ $relato->titulo }}</h3>
                    {{-- Fecha de publicación del relato --}}
                    <p class="text-gray-500">
                        {{ \Carbon\Carbon::parse($relato->fecha_publicacion)->translatedFormat('d \d\e F \d\e Y') }}
                    </p>
                    {{-- Géneros del relato. Mostramos cada relato como una pill --}}
                    <div class="flex flex-wrap mt-2">
                        @foreach ($relato->generos as $genero)
                            <span
                                class="px-2 py-1 mr-2 text-sm text-white bg-blue-500 rounded-full">{{ $genero->nombre }}</span>
                        @endforeach
                    </div>
                    {{-- Mostramos el resumen del relato --}}
                    <p class="mt-2 text-gray-500">{{ $relato->resumen }}</p>

                    <div class="mt-4">
                        {{-- Enlace para ver el relato completo --}}
                        <a href="{{ route('relatos.show', $relato) }}" class="text-blue-500 hover:text-blue-700">Ver
                            relato</a>
                        {{-- Enlace para editar el relato --}}
                        <a href="{{ route('relatos.edit', $relato) }}"
                            class="ml-2 text-orange-500 hover:text-orange-700">Editar</a>
                        {{-- Enlace para eliminar el relato --}}
                        <form action="{{ route('relatos.destroy', $relato) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-2 text-red-500 hover:text-red-700">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No tienes relatos creados.</p>
    @endif
    {{-- Paginación de los relatos --}}
    <div class="mt-4">
        {{ $relatos->links() }}
    </div>
</div>
