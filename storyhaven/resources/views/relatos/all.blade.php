<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Todos los relatos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                                        <strong>Autor:</strong> {{ $relato->autor->name }} {{ $relato->autor->surname }}
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
                                        <a href="{{ route('relatos.show', $relato) }}"
                                            class="text-blue-500 hover:text-blue-700">Ver relato</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No hay relatos disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
