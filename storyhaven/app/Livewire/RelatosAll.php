<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Relato;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class RelatosAll extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $search = ''; // Variable para la búsqueda.
    public $typeSearch = 'titulo'; // Variable para el tipo de búsqueda.

    public function render()
    {
        $query = Relato::query(); // Consulta a la tabla relatos.

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
            ->paginate(6);

        return view('livewire.relatos-all')->with('relatos', $relatos);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
