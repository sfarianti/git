<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeputusanBOD extends Model
{
    use HasFactory;
    protected $table = 'keputusan_bods';
    protected $fillable = [
        'pvt_event_teams_id',
        'val_peringkat',
    ];
}
