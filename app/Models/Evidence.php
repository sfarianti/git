<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasFactory;
    protected $table = 'evidences';
    protected $primaryKey = 'id';
    protected $fillable = ['member_id','event_name','prestasi','file_certificate', 'team_id' ,'year'];
}
