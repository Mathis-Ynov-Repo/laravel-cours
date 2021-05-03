<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    public $incrementing = false;


    protected $fillable = [
        'reference',
        'title',
        'deposit',
        'address'
    ];

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
    public function missionLines()
    {
        return $this->hasMany(MissionLine::class);
    }
}
