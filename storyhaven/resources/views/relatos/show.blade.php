<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detalles del Relato') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-lg sm:rounded-lg">
                <div class="p-6">
                    {{-- Título del relato --}}
                    <h3 class="text-2xl font-bold text-gray-900">{{ $relato->titulo }}</h3>

                    {{-- Fecha de publicación --}}
                    <p class="mt-2 text-gray-600">
                        Publicado el
                        {{ \Carbon\Carbon::parse($relato->fecha_publicacion)->translatedFormat('d \d\e F \d\e Y') }}
                    </p>

                    {{-- Autor del relato --}}
                    <p class="mt-2 text-gray-700">
                        <span class="font-semibold">Autor:</span> {{ $relato->autor->name }}
                        {{ $relato->autor->surname }}
                    </p>

                    {{-- Géneros --}}
                    <div class="mt-4">
                        <span class="font-semibold text-gray-700">Géneros:</span>
                        <div class="flex flex-wrap mt-2">
                            @foreach ($relato->generos as $genero)
                                <span
                                    class="px-3 py-1 mr-2 text-sm text-white bg-blue-500 rounded-full">{{ $genero->nombre }}</span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Resumen del relato --}}
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold text-gray-800">Resumen</h3>
                        <p class="mt-2 text-gray-600">{{ $relato->resumen }}</p>
                    </div>

                    {{-- Botón para descargar el PDF --}}
                    <div class="mt-6">
                        <a href="{{ route('relatos.download', $relato) }}"
                            class="px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700">
                            Descargar PDF
                        </a>
                    </div>

                    {{-- Volver a la lista de relatos --}}
                    <div class="mt-6">
                        <a href="{{ route('relatos.all') }}" class="text-blue-500 hover:underline">
                            &larr; Volver a Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
