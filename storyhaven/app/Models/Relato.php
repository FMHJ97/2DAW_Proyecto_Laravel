<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relato extends Model
{
    /** @use HasFactory<\Database\Factories\RelatoFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /*
    Relación uno a muchos inversa con la tabla users.
    */
    public function autor()
    {
        /*
        La foreign key es user_id, por lo que se pasa como segundo argumento al método belongsTo.
        */
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
    Relación muchos a muchos con la tabla generos.
    */
    public function generos()
    {
        return $this->belongsToMany(Genero::class);
    }

}
