<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Editar relato') }}
        </h2>
        {{-- Mensaje de error proveniente del controlador --}}
        @if (session('error'))
            <div class="mt-4 text-red-500">{{ session('error') }}</div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Formulario para la modificación de un relato --}}
                    <form method="POST" action="{{ route('relatos.update', $relato) }}" enctype="multipart/form-data"
                        class="grid grid-cols-2 gap-6">
                        @csrf
                        @method('PUT')

                        <!-- Columna izquierda: Campos del formulario -->
                        <div>
                            <!-- Título del relato -->
                            <div>
                                <x-input-label for="titulo" :value="__('Título del relato')" />
                                <x-text-input id="titulo" class="block w-full mt-1" type="text" name="titulo"
                                    :value="old('titulo', $relato->titulo)" autofocus required />
                                @error('titulo')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Resumen del relato -->
                            <div class="mt-4">
                                <x-input-label for="resumen" :value="__('Resumen')" />
                                <textarea id="resumen" name="resumen" rows="3"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required>{{ old('resumen', $relato->resumen) }}</textarea>
                                @error('resumen')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Géneros del relato -->
                            <div class="mt-4">
                                <x-input-label :value="__('Selecciona los géneros')" />
                                <div class="flex flex-wrap">
                                    @foreach ($generos as $genero)
                                        <label class="mr-4">
                                            <input type="checkbox" name="generos[]" value="{{ $genero->id }}"
                                                {{-- Si el género está en la lista de géneros del relato, marcarlo --}}
                                                {{ in_array($genero->id, old('generos', $relato->generos->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            {{ $genero->nombre }}
                                        </label>
                                    @endforeach
                                </div>
                                @error('generos')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Subida de PDF -->
                            <div class="mt-4">
                                <x-input-label for="contenido_pdf" :value="__('Subir PDF')" />
                                <input id="contenido_pdf" class="block w-full mt-1 border" type="file"
                                    name="contenido_pdf" accept="application/pdf" onchange="previewPDF(event)" />
                                @error('contenido_pdf')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex items-center justify-start gap-2 mt-4">
                                <x-primary-button>
                                    {{ __('Actualizar Relato') }}
                                </x-primary-button>
                                <a href="{{ route('relatos.index') }}">
                                    <x-secondary-button>
                                        {{ __('Cancelar') }}
                                    </x-secondary-button>
                                </a>
                            </div>
                        </div>

                        <!-- Columna derecha: Previsualización del PDF -->
                        <div class="p-4 bg-gray-100 border rounded-lg ">
                            <p class="text-lg font-semibold text-gray-700">Vista previa del PDF</p>
                            <!-- Verificar si ya existe un archivo PDF y previsualizarlo -->
                            @if ($relato->contenido_pdf)
                                <iframe id="pdfPreview" class="w-full h-[500px] mt-2 border rounded-lg"
                                    src="{{ asset('storage/relatos/' . $relato->contenido_pdf) }}"></iframe>
                                <p id="noFileText" class="mt-2 text-gray-500" style="display: none;">No se ha
                                    seleccionado ningún archivo.</p>
                            @else
                                <iframe id="pdfPreview" class="w-full h-[500px] mt-2 border rounded-lg"
                                    style="display: none;"></iframe>
                                <p id="noFileText" class="mt-2 text-gray-500">No se ha seleccionado ningún archivo.</p>
                            @endif
                        </div>
                    </form>

                    <script>
                        // Función para previsualizar el PDF seleccionado.
                        function previewPDF(event) {
                            const file = event.target.files[0]; // Archivo seleccionado.
                            const pdfPreview = document.getElementById('pdfPreview'); // Iframe de previsualización.
                            const noFileText = document.getElementById('noFileText'); // Mensaje de error.

                            if (file && file.type === "application/pdf") {
                                // Crear una URL para el archivo seleccionado
                                // y mostrarlo en el iframe.
                                const fileURL = URL.createObjectURL(file);
                                // Mostrar el iframe y ocultar el mensaje de error.
                                pdfPreview.src = fileURL;
                                pdfPreview.style.display = "block";
                                noFileText.style.display = "none";
                            } else {
                                pdfPreview.style.display = "none";
                                noFileText.style.display = "block";
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
