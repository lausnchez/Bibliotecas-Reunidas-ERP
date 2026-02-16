<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Campos rellenables
    protected $fillable = [
        'nombre',
        'apellidos',
    ];

    // Relaciones
    //--------------------------------------------------------------
    public function libros(){
        return $this->hasMany(Libro::class, 'autor');
    }
}
