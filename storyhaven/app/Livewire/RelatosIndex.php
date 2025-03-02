<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\Relato;

class RelatosIndex extends Component
{

    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        // Obtenemos todos los relatos del usuario autenticado.
        $autenticado = auth()->user();
        $relatos = $autenticado->relatos()->orderBy('fecha_publicacion', 'desc')->paginate(6);
        // Retornamos la vista con los relatos.
        return view('livewire.relatos-index')->with('relatos', $relatos);
    }
}
