<?php

namespace App\Enums;

enum Estados:string
{
    case BuenEstado = 'buen estado';
    case Neutral = 'neutral';
    case AlgoDanado = 'algo dañado';
    case muyDanado = 'muy dañado';
}
