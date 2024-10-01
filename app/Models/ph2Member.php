<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ph2Member extends Model
{
    use HasFactory;

    protected $table = 'ph2_members';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ph2_id',
        'name',
        'team_id',
    ];
    // public function paper()
    // {
    //     return $this->hasOne(Paper::class, 'team_id', 'id');
    // }
}
