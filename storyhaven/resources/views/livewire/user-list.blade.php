<div>
    {{-- Buscador --}}
    <div class="max-w-lg mb-5">
        <div class="flex">
            <!-- Dropdown de tipo de búsqueda -->
            <select wire:model.live="typeSearch"
                class="shrink-0 z-10 inline-flex items-center py-2.5 px-6 pe-8 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none">
                <option value="username">Usuario</option>
                <option value="email">Email</option>
            </select>

            <!-- Input de búsqueda -->
            <div class="relative w-full">
                <input type="text" wire:model.live="search"
                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none"
                    placeholder="Buscar..." />
            </div>
        </div>
    </div>
    @if ($users->isEmpty())
        <p class="text-gray-500">No hay usuarios disponibles.</p>
    @else
        {{-- Tabla de usuarios --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-600 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nombre y apellidos
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Usuario
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Rol
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr wire:key='user-{{ $user->id }}'
                            class="text-center bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->name }} {{ $user->surname }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->username }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->role == 'admin')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:text-yellow-100 dark:bg-yellow-700">
                                        Administrador
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-700">
                                        Usuario
                                    </span>
                                @endif
                            </td>
                            <td class="flex items-center justify-center gap-3 py-4 text-sm">
                                <button wire:click="switchRole({{ $user->id }})"
                                    class="flex items-center px-3 py-1 text-sm font-semibold text-white transition bg-green-500 rounded hover:bg-green-600 dark:bg-green-700 dark:hover:bg-green-800">
                                    <svg class="w-5 h-5 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M8 20V7m0 13-4-4m4 4 4-4m4-12v13m0-13 4 4m-4-4-4 4" />
                                    </svg>
                                    Cambiar Rol
                                </button>
                                <button wire:click="deleteUser({{ $user->id }})"
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
            {{ $users->links() }}
        </div>
    @endif
</div>
