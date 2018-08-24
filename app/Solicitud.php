<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $fillable = ['monto','edad','tarjeta','plazo','porcentaje','id_usuario','estatus'];
}
