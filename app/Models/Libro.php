<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libros';
    protected $fillable = ['titulo', 'autor', 'disponible'];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}

