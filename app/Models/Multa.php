<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    protected $table = 'multas';
    protected $fillable = ['usuario_id', 'monto', 'motivo', 'pagada'];
    protected $casts = ['pagada' => 'boolean'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
