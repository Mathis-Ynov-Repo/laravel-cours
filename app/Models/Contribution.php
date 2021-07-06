<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $with = ['transaction', 'organisation'];


    protected $fillable = [
        'price',
        'title',
        'comment',
        'address'
    ];

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
    public function transaction()
    {
        return $this->morphMany(Transaction::class, 'source');
    }
}
