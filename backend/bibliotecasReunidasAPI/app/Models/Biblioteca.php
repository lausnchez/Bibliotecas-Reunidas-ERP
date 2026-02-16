<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biblioteca extends Model
{
    protected $table = 'bibliotecas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Campos rellenables
    protected $fillable = [
        'nombre',
        'provincia',
        'ciudad',
        'calle',
        'telefono',
        'email',
    ];

    // Relaciones
    //--------------------------------------------------------------
    public function libros(){
        return $this->hasMany(Libro::class, 'biblioteca');
    }

    public function socios(){
        return $this->hasMany(Socio::class, 'biblioteca');
    }

    public function prestamos(){
        return $this->hasMany(Prestamo::class, 'id_biblioteca');
    }

    public function sanciones(){
        return $this->hasMany(Sancion::class, 'id_biblioteca');
    }
}
