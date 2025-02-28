<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class UserList extends Component
{
    /*
    Permite la paginación de los registros de la tabla cars.
    WithoutUrlPagination: Permite que la paginación no se vea reflejada
    en la URL.
    */
    use WithPagination, WithoutUrlPagination;

    public function deleteUser($id)
    {
        // Buscamos el usuario por su id.
        $user = User::find($id);

        // Si el usuario existe.
        if ($user) {
            // Eliminamos el usuario.
            $user->delete();
        }
    }

    /**
     * Función para cambiar el rol de un usuario.
     *
     * @param  int  $id
     * @return void
     */
    public function switchRole($id)
    {
        // Buscamos el usuario por su id.
        $user = User::find($id);

        // Si el usuario existe.
        if ($user) {
            // Cambiamos el rol del usuario.
            $user->role = $user->role == 'user' ? 'admin' : 'user';
            $user->save();
        }
    }

    public function render()
    {
        // Devolvemos todos los usuarios paginados excepto el usuario autenticado.
        $users = User::where('id', '!=', Auth::id())->paginate(10);

        // Mostramos la vista 'livewire.user-list' con los usuarios paginados.
        return view('livewire.user-list')->with('users', $users);
    }

}
