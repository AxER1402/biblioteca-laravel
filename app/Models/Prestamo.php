<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = 'prestamos';
    protected $fillable = ['usuario_id', 'libro_id', 'fecha_inicio', 'fecha_vencimiento', 'fecha_devolucion'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}
