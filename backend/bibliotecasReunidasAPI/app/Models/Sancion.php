<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
    protected $table = 'sanciones';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_socio',
        'id_biblioteca',
        'fecha',
        'pagado',
    ];

    protected $casts = [
        'id' => 'integer',
        'id_socio' => 'integer',
        'id_biblioteca' => 'integer',
        'fecha' => 'date',
        'pagado' => 'boolean',
    ];

    // Relaciones
    //--------------------------------------------------------------
    public function socio(){
        return $this->belongsTo(Socio::class, 'id_socio');
    }

    public function biblioteca(){
        return $this->belongsTo(Biblioteca::class, 'id_biblioteca');
    }
}
