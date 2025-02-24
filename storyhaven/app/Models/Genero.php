<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    /** @use HasFactory<\Database\Factories\GeneroFactory> */
    use HasFactory;

    /*
    / Evita que Eloquent intente manejar created_at y updated_at.
    */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /*
    Relación muchos a muchos con la tabla relatos.
    */
    public function relatos()
    {
        return $this->belongsToMany(Relato::class);
    }

}
