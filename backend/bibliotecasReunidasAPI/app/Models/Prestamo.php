<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = 'prestamos';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_libro',
        'id_socio',
        'id_biblioteca',
        'fecha_prestamo',
        'fecha_devolucion',
        'devuelto',
    ];

    protected $casts = [
        'id' => 'integer',
        'id_libro' => 'integer',
        'id_socio' => 'integer',
        'id_biblioteca' => 'integer',
        'fecha_prestamo' => 'datetime',
        'fecha_devolucion' => 'datetime',
        'devuelto' => 'boolean',
    ];

    // Relaciones
    //--------------------------------------------------------------
    
    public function libro(){
        return $this->belongsTo(Libro::class, 'id_libro');
    }

    public function socio(){
        return $this->belongsTo(Socio::class, 'id_socio');
    }

    public function biblioteca(){
        return $this->belongsTo(Biblioteca::class, 'id_biblioteca');
    }
}
