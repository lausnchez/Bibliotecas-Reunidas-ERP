<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    protected $table = 'socios';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'biblioteca',
        'dni',
        'nombre',
        'apellidos',
        'tlf',
        'email',
        'provincia',
        'ciudad',
        'calle',
        'pagoRealizado',
        'socioActual',
    ];


    protected $casts = [
        'id' => 'integer',
        'biblioteca' => 'integer',
        'pagoRealizado' => 'boolean',
        'socioActual' => 'boolean',
    ];

    // Relaciones
    //--------------------------------------------------------------
    
    public function bibliotecaRel(){
        return $this->belongsTo(Biblioteca::class, 'biblioteca');
    }

    public function prestamos(){
        return $this->hasMany(Prestamo::class, 'id_socio');
    }

    public function sanciones(){
        return $this->hasMany(Sancion::class, 'id_socio');
    }

    public function getNombreCompletoAttribute(){
        return "{$this->nombre} {$this->apellidos}";
    }
}
