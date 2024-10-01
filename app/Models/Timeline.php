<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

        // Nama tabel di database
        protected $table = 'timeline';

        // Kolom yang dapat diisi
        protected $fillable = [
            'tanggal_mulai',
            'tanggal_selesai',
            'judul_kegiatan',
            'deskripsi',
        ];
}
