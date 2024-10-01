<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodEvent extends Model
{
    use HasFactory;
    protected $table = 'bod_events';
    protected $fillable = ['employee_id','event_id', 'status'];
}
