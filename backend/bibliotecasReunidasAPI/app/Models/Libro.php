<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libros';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'biblioteca',
        'autor',
        'ISBN',
        'editorial',
        'precio',
        'estado',
    ];

    protected $casts = [
        'id' => 'integer',
        'biblioteca' => 'integer',
        'autor' => 'integer',
        'precio' => 'decimal:2',
        'estado' => \App\Enums\Estados::class,
    ];

    // Relaciones
    //--------------------------------------------------------------
    public function autorRel(){
        return $this->belongsTo(Autor::class, 'autor');
    }

    public function bibliotecaRel(){
        return $this->belongsTo(Biblioteca::class, 'biblioteca');
    }

    public function prestamos(){
        return $this->hasMany(Prestamo::class, 'id_libro');
    }
}
