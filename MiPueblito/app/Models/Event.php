<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'start',
        'end'
        ,'recurrence'
        ,'event_id'
        ,'user_id'
        ,'user_name'
        ,'lugar'
        ,'description'
    ];
   
}
