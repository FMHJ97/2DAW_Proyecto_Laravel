<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Relato;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class RelatosAll extends Component
{

    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        // Obtenemos todos los relatos según la fecha de publicación de forma descendente.
        $relatos = Relato::orderBy('fecha_publicacion', 'desc')->paginate(6);
        // Retornamos la vista con los relatos.
        return view('livewire.relatos-all')->with('relatos', $relatos);
    }
}
