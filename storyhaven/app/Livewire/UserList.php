<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class UserList extends Component
{

    public $search = '';
    public $typeSearch = 'username';

    /*
    Permite la paginación de los registros de la tabla users.
    WithoutUrlPagination: Permite que la paginación no se vea reflejada
    en la URL.
    */
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        // Obtenemos los usuarios que no sean el usuario autenticado.
        // Cuando se realiza una búsqueda, se filtran los usuarios por el tipo de búsqueda.
        $users = User::where('id', '!=', Auth::id())
            ->when($this->search, function ($query) {
                $query->where($this->typeSearch, 'like', '%' . $this->search . '%');
            })
            ->paginate(5); // Paginamos los resultados.

        return view('livewire.user-list')->with('users', $users);
    }

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

    public function updatingSearch()
    {
        $this->resetPage();
    }

}
