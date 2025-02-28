<div>
    @if ($users->isEmpty())
        <div class="flex items-center justify-center h-96">
            <div class="text-center">
                <h1 class="text-3xl font-semibold text-gray-700 dark:text-gray-400">
                    No hay usuarios registrados
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    No se han encontrado usuarios registrados en la base de datos.
                </p>
            </div>
        </div>
    @else
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre y apellidos
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Usuario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rol
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
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
                            <td class="px-6 py-4 text-sm">
                                <button wire:click="switchRole({{ $user->id }})"
                                    class="px-3 py-1 text-sm font-semibold text-white transition bg-green-500 rounded hover:bg-green-600 dark:bg-green-700 dark:hover:bg-green-800">
                                    Cambiar Rol
                                </button>
                                <button wire:click="deleteUser({{ $user->id }})"
                                    class="px-3 py-1 text-sm font-semibold text-white transition bg-red-500 rounded hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800">
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
