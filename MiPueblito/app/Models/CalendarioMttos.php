<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarioMttos extends Model
{
    use HasFactory;
     protected $fillable = [
        'title'
        ,'start'
        ,'end'
        ,'recurrence'
        ,'event_id'
        ,'user_id'
        ,'user_name'
        ,'lugar'
        ,'description'
        ,'dispositivo'
        ,'dispositivo_id'
        ,'correo'
        ,'departamento'
        ,'estatus'
        ,'background'
    ];
}
