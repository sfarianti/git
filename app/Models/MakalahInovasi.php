<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakalahInovasi extends Model
{
    use HasFactory;

    protected $table = 'makalah_inovasi';

    public $timestamps = true;

    protected $fillable = [
        'nama_tim',
        'nama_perusahaan',
        'nama_ketua',
        'judul_inovasi',
        'event',
        'kategori'
    ];

    protected $hidden = [
    // add here for hidden attrib
    
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}
