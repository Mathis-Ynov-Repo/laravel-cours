<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionLine extends Model
{
    use HasFactory;

    public $incrementing = false;


    protected $fillable = [
        'title',
        'quantity',
        'price',
        'unity'
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
