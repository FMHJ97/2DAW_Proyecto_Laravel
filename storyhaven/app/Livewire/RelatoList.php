<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Relato;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class RelatoList extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = ''; // Variable para la búsqueda.
    public $typeSearch = 'titulo'; // Variable para el tipo de búsqueda.
    public $includeDeleted = false; // Variable para incluir relatos eliminados.

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

    public function render()
    {
        $query = Relato::query(); // Consulta a la tabla relatos.

        // Si la variable includeDeleted es true, solo se muestran los relatos eliminados.
        if ($this->includeDeleted) {
            $query->onlyTrashed(); // Solo relatos eliminados.
        }

        // Se ordenan los relatos por fecha de publicación de forma descendente.
        $relatos = $query
            ->orderBy('fecha_publicacion', 'desc')
            ->when($this->search, function ($query) {
                switch ($this->typeSearch) {
                    case 'titulo':
                        $query->where('titulo', 'like', '%' . $this->search . '%');
                        break;
                    case 'autor':
                        $query->whereHas('autor', function ($query) {
                            $query->where('username', 'like', '%' . $this->search . '%');
                        });
                        break;
                    case 'generos':
                        $query->whereHas('generos', function ($query) {
                            $query->where('nombre', 'like', '%' . $this->search . '%');
                        });
                        break;
                }
            })
            ->paginate(5);

        return view('livewire.relato-list')->with('relatos', $relatos);
    }

    public function deleteRelato($id)
    {
        // Buscamos el relato por su id.
        $relato = Relato::find($id);

        if ($relato) {
            // Eliminamos el relato.
            $relato->delete();
            // Mensaje de éxito.
            session()->flash('message', 'Relato eliminado correctamente.');
        }
    }

    public function restoreRelato($id)
    {
        // Buscamos el relato por su id.
        $relato = Relato::withTrashed()->find($id);

        if ($relato) {
            // Restauramos el relato.
            $relato->restore();
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
