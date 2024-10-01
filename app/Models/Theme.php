<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    protected $table = 'themes';
    protected $fillable = ['theme_name'];

    public function teams()
    {
        return $this->hasMany(Team::class, 'foreign_key', 'theme_id');
    }
}
