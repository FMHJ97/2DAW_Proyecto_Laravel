<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\Relato;
use Illuminate\Support\Facades\Auth;

class RelatosIndex extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $search = ''; // Variable para la búsqueda.
    public $typeSearch = 'titulo'; // Variable para el tipo de búsqueda.

    // Propiedades para el modal de confirmación
    public $showDeleteModal = false;
    public $relatoIdToDelete = null;
    public $relatoToDelete = null;

    // Método para mostrar el modal de confirmación
    public function confirmRelatoDeletion($relatoId)
    {
        $this->relatoIdToDelete = $relatoId;
        $this->relatoToDelete = Relato::find($relatoId);
        $this->showDeleteModal = true;
    }

    // Método para cerrar el modal sin eliminar
    public function cancelRelatoDeletion()
    {
        $this->reset(['showDeleteModal', 'relatoIdToDelete', 'relatoToDelete']);
    }

    // Método para confirmar la eliminación
    public function deleteConfirmed()
    {
        $this->deleteRelato($this->relatoIdToDelete);
        $this->reset(['showDeleteModal', 'relatoIdToDelete', 'relatoToDelete']);
    }

    public function deleteRelato($id)
    {
        // Buscamos el relato por su id.
        $relato = Relato::find($id);

        if ($relato) {
            // Eliminamos el relato.
            $relato->delete();
            // Redireccionamos a la página de relatos.
            return redirect()->route('relatos.index')->with('alert', [
                'type' => 'success',
                'message' => 'Relato eliminado correctamente.'
            ]);
        }

        // Si no se encuentra el relato, se redirecciona a la página de relatos.
        return redirect()->route('relatos.index')->with('alert', [
            'type' => 'error',
            'message' => 'No se ha podido eliminar el relato.'
        ]);
    }

    public function render()
    {
        $query = Relato::where('user_id', Auth::id()); // Consulta a la tabla relatos del usuario autenticado.

        // Se ordenan los relatos por fecha de publicación de forma descendente.
        $relatos = $query
            ->orderBy('fecha_publicacion', 'desc')
            ->when($this->search, function ($query) {
                switch ($this->typeSearch) {
                    case 'titulo':
                        $query->where('titulo', 'like', '%' . $this->search . '%');
                        break;
                    case 'generos':
                        $query->whereHas('generos', function ($query) {
                            $query->where('nombre', 'like', '%' . $this->search . '%');
                        });
                        break;
                }
            })
            ->paginate(6);

        return view('livewire.relatos-index')->with('relatos', $relatos);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
