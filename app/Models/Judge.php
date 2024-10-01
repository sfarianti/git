<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    use HasFactory;
    protected $table = 'judges';
    protected $fillable = [
        'employee_id',
        'event_id',
        'description',
        'year',
        'status'
    ];
}
