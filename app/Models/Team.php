<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $fillable = [
        'team_name',
        'company_code',
        // 'fasilitator_employee_id',
        'category_id',
        'theme_id',
        // 'event_id',
        'status_lomba',
        'phone_number'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'pvt_members');
    }
    // public function users()
    // {
    //     return $this->hasMany(PvtMember::class, 'team_id');
    // }
    // public function facilitator()
    // {
    //     return $this->belongsTo(User::class, 'fasilitator_employee_id', 'employee_id');
    // }
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
    public function themes()
    {
        return $this->belongsTo(Theme::class);
    }
    // public function events()
    // {
    //     return $this->belongsTo(Event::class);
    // }
    public function paper()
    {
        return $this->hasOne(Paper::class, 'team_id', 'id');
    }
    public function history()
    {
        return $this->hasOne(history::class, 'team_id', 'id');
    }
    public function pvtMembers()
    {
        return $this->hasMany(PvtMember::class, 'team_id');
    }
}
