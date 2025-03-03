<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-indigo-900">
            {{ __('Nuevo relato') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-100 via-purple-50 to-amber-50">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden border shadow-lg bg-slate-50 border-amber-200 sm:rounded-xl">
                <div class="p-6 text-gray-900">
                    {{-- Mensaje de error proveniente del controlador --}}
                    @if (session('error'))
                        <div class="p-4 mb-6 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-red-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    {{-- Formulario para la creación de un nuevo relato --}}
                    <form method="POST" action="{{ route('relatos.store') }}" enctype="multipart/form-data"
                        class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                        @csrf

                        <!-- Columna izquierda: Campos del formulario -->
                        <div class="p-6 bg-white border border-indigo-100 rounded-lg shadow-sm">
                            <h3 class="mb-6 text-lg font-semibold text-indigo-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Información del relato
                            </h3>

                            <!-- Título del relato -->
                            <div class="mb-5">
                                <label for="titulo" class="block mb-2 text-sm font-medium text-indigo-700">Título del
                                    relato</label>
                                <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}"
                                    class="bg-white border border-indigo-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                    placeholder="Escribe un título atractivo" required autofocus>
                                @error('titulo')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Resumen del relato -->
                            <div class="mb-5">
                                <label for="resumen"
                                    class="block mb-2 text-sm font-medium text-indigo-700">Resumen</label>
                                <textarea id="resumen" name="resumen" rows="4"
                                    class="bg-white border border-indigo-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                    placeholder="Escribe un breve resumen de tu historia" required>{{ old('resumen') }}</textarea>
                                @error('resumen')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Géneros del relato -->
                            <div class="mb-5">
                                <label class="block mb-3 text-sm font-medium text-indigo-700">Selecciona los
                                    géneros (máx. 4)</label>
                                <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                    @foreach ($generos as $genero)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="genero-{{ $genero->id }}" name="generos[]"
                                                value="{{ $genero->id }}"
                                                {{ in_array($genero->id, old('generos', [])) ? 'checked' : '' }}
                                                class="w-4 h-4 text-indigo-600 border-indigo-300 rounded focus:ring-indigo-500">
                                            <label for="genero-{{ $genero->id }}" class="ml-2 text-sm text-gray-700">
                                                {{ $genero->nombre }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('generos')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Subida de PDF -->
                            <div class="mb-5">
                                <label for="contenido_pdf" class="block mb-2 text-sm font-medium text-indigo-700">Subir
                                    PDF</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="contenido_pdf"
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-indigo-300 border-dashed rounded-lg cursor-pointer bg-indigo-50 hover:bg-indigo-100">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-10 h-10 mb-3 text-indigo-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="mb-2 text-sm text-indigo-700"><span class="font-semibold">Haz clic
                                                    para subir</span> o arrastra y suelta</p>
                                            <p class="text-xs text-gray-500">PDF (MAX. 10MB)</p>
                                        </div>
                                        <input id="contenido_pdf" type="file" name="contenido_pdf"
                                            accept="application/pdf" class="hidden" onchange="previewPDF(event)"
                                            required />
                                    </label>
                                </div>
                                <div id="file-selected"
                                    class="hidden p-2 mt-3 text-sm text-indigo-700 rounded-lg bg-indigo-50"></div>
                                @error('contenido_pdf')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-start mt-8">
                                <button type="submit"
                                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Publicar relato
                                </button>

                                <a href="{{ route('relatos.index') }}"
                                    class="inline-flex items-center px-5 py-2.5 ml-4 text-sm font-medium text-indigo-700 bg-white border border-indigo-300 rounded-lg hover:bg-indigo-50 focus:ring-4 focus:ring-indigo-300">
                                    Cancelar
                                </a>
                            </div>
                        </div>

                        <!-- Columna derecha: Previsualización del PDF -->
                        <div class="overflow-hidden bg-white border border-indigo-100 rounded-lg shadow-sm">
                            <div class="p-4 border-b border-indigo-100 bg-indigo-50">
                                <h3 class="text-lg font-semibold text-indigo-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Vista previa del PDF
                                </h3>
                            </div>

                            <div class="p-4">
                                <div class="relative overflow-hidden bg-gray-100 rounded-lg">
                                    {{-- El iframe con el PDF --}}
                                    <iframe id="pdfPreview"
                                        class="w-full h-[640px] border border-indigo-200 rounded-md"
                                        style="display: none;" title="Vista previa del relato en formato PDF">
                                    </iframe>

                                    {{-- Estado inicial: no hay archivo --}}
                                    <div id="noFileContainer"
                                        class="flex flex-col items-center justify-center h-[500px] bg-indigo-50 border border-indigo-200 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4 text-indigo-300"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p id="noFileText" class="text-lg font-medium text-indigo-700">No se ha
                                            seleccionado ningún archivo</p>
                                        <p class="max-w-md mt-2 text-sm text-center text-gray-500">Sube un archivo PDF
                                            para ver una vista previa aquí</p>
                                    </div>

                                    {{-- Overlay cuando se selecciona un archivo --}}
                                    <div id="pdfOverlay"
                                        class="absolute inset-0 flex flex-col items-center justify-center bg-indigo-900 bg-opacity-20"
                                        style="display: none;">
                                        <div class="max-w-md p-4 text-center bg-white rounded-lg shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-12 h-12 mx-auto mb-3 text-indigo-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            <h5 class="mb-2 text-lg font-bold text-indigo-800">Vista previa limitada
                                            </h5>
                                            <p class="mb-4 text-sm text-gray-600">Esta es una vista previa limitada. El
                                                PDF se publicará cuando guardes el relato.</p>
                                        </div>
                                    </div>
                                </div>

                                <p class="mt-3 text-xs italic text-center text-gray-500">
                                    La vista previa del PDF es solo referencial. Su visualización final puede variar
                                    ligeramente.
                                </p>
                            </div>
                        </div>
                    </form>

                    <script>
                        // Función para previsualizar el PDF seleccionado.
                        function previewPDF(event) {
                            const file = event.target.files[0]; // Archivo seleccionado.
                            const pdfPreview = document.getElementById('pdfPreview'); // Iframe de previsualización.
                            const noFileContainer = document.getElementById('noFileContainer'); // Contenedor mensaje inicial
                            const pdfOverlay = document.getElementById('pdfOverlay'); // Overlay con mensaje
                            const fileSelected = document.getElementById('file-selected'); // Texto archivo seleccionado

                            if (file && file.type === "application/pdf") {
                                // Crear una URL para el archivo seleccionado y mostrarlo en el iframe.
                                const fileURL = URL.createObjectURL(file);

                                // Actualizar el iframe
                                pdfPreview.src = fileURL;
                                pdfPreview.style.display = "block";

                                // Mostrar overlay y ocultar mensaje "no hay archivo"
                                pdfOverlay.style.display = "flex";
                                noFileContainer.style.display = "none";

                                // Mostrar nombre del archivo seleccionado
                                fileSelected.textContent = `Archivo seleccionado: ${file.name}`;
                                fileSelected.classList.remove('hidden');
                            } else {
                                // Si no es un PDF o no hay archivo
                                pdfPreview.style.display = "none";
                                pdfOverlay.style.display = "none";
                                noFileContainer.style.display = "flex";
                                fileSelected.classList.add('hidden');

                                if (file) {
                                    // Si se seleccionó un archivo que no es PDF
                                    document.getElementById('noFileText').textContent = "El archivo seleccionado no es un PDF";
                                } else {
                                    // Si no se seleccionó ningún archivo
                                    document.getElementById('noFileText').textContent = "No se ha seleccionado ningún archivo";
                                }
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
