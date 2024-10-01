<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodEventValue extends Model
{
    use HasFactory;
    protected $table = 'bod_event_values';
    protected $fillable = [
        'event_team_id', 
        'value'
    ];
}
