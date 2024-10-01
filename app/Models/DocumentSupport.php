<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentSupport extends Model
{
    use HasFactory;
    protected $table = 'document_supportings';
    protected $fillable = [
        'paper_id',
        'file_name',
        'path'
    ];
    
    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }
}
