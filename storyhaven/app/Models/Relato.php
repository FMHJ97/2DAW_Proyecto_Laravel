<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relato extends Model
{
    /** @use HasFactory<\Database\Factories\RelatoFactory> */
    use HasFactory;
    use SoftDeletes;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
