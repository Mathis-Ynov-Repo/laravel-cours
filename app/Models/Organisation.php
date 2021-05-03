<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'slug',
        'name',
        'email',
        'address'
    ];

    public function missions()
    {
        return $this->hasMany(Mission::class, 'organisation_id', 'id');
    }
    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }
}
