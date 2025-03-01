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
