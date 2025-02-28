<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Relato;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class RelatoList extends Component
{

    public $search = '';
    public $typeSearch = 'titulo';

    /*
    Permite la paginación de los registros de la tabla relatos.
    WithoutUrlPagination: Permite que la paginación no se vea reflejada
    en la URL.
    */
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        // Obtenemos los relatos, ordenados por fecha de publicación.
        $relatos = Relato::orderBy('fecha_publicacion', 'desc')
            ->when($this->search, function ($query) {
                switch ($this->typeSearch) {
                    // Filtrado por título
                    case 'titulo':
                        $query->where('titulo', 'like', '%' . $this->search . '%');
                        break;

                    // Filtrado por autor
                    case 'autor':
                        $query->whereHas('autor', function ($query) {
                            $query->where('username', 'like', '%' . $this->search . '%');
                        });
                        break;

                    // Filtrado por género
                    case 'generos':
                        $query->whereHas('generos', function ($query) {
                            $query->where('nombre', 'like', '%' . $this->search . '%');
                        });
                        break;
                }
            })
            ->paginate(5); // Paginamos los resultados.

        // Retornamos la vista con los relatos.
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

    public function showRelato($id)
    {
        // Redirigimos a la vista del relato.
        return redirect()->route('relatos.show', $id);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
