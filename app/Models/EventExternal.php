<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventExternal extends Model
{
    use HasFactory;
    protected $table = 'event_externals';

    protected $fillable = [
        'team_id', 
        'innovation_title',
        'file_paper',
        'video',
        'ppt',
    ];

}
