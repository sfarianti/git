<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinimumscoreEvent extends Model
{
    use HasFactory;

    protected $table = 'minimumscore_events';

    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'score_minimum_oda',
        'score_minimum_pa',
        'category',
        'year',
    ];
}
