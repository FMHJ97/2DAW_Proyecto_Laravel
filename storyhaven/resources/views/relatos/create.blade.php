<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Nuevo relato') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Formulario para la creación de un nuevo relato --}}
                    <form method="POST" action="{{ route('relatos.store') }}" enctype="multipart/form-data"
                        class="grid grid-cols-2 gap-6">
                        @csrf

                        <!-- Columna izquierda: Campos del formulario -->
                        <div>
                            <!-- Título del relato -->
                            <div>
                                <x-input-label for="title" :value="__('Título del relato')" />
                                <x-text-input id="title" class="block w-full mt-1" type="text" name="title"
                                    :value="old('title')" autofocus required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Resumen del relato -->
                            <div class="mt-4">
                                <x-input-label for="summary" :value="__('Resumen')" />
                                <x-text-input id="summary" class="block w-full mt-1" type="text" name="summary"
                                    :value="old('summary')" required />
                                <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                            </div>

                            <!-- Géneros del relato -->
                            <div class="mt-4">
                                <x-input-label :value="__('Selecciona los géneros')" />
                                <div class="flex flex-wrap">
                                    @foreach ($generos as $genero)
                                        <label class="mr-4">
                                            <input type="checkbox" name="generos[]" value="{{ $genero->id }}">
                                            {{ $genero->nombre }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Subida de PDF -->
                            <div class="mt-4">
                                <x-input-label for="pdf" :value="__('Subir PDF')" />
                                <input id="pdf" class="block w-full mt-1 border" type="file" name="pdf"
                                    accept="application/pdf" required onchange="previewPDF(event)" />
                                <x-input-error :messages="$errors->get('pdf')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-start mt-4">
                                <x-primary-button>
                                    {{ __('Guardar Relato') }}
                                </x-primary-button>
                            </div>
                        </div>

                        <!-- Columna derecha: Previsualización del PDF -->
                        <div class="p-4 bg-gray-100 border rounded-lg ">
                            <p class="text-lg font-semibold text-gray-700">Vista previa del PDF</p>
                            <iframe id="pdfPreview" class="w-full h-[500px] mt-2 border rounded-lg"
                                style="display: none;"></iframe>
                            <p id="noFileText" class="mt-2 text-gray-500">No se ha seleccionado ningún archivo.</p>
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
