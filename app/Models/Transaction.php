<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $incrementing = false;

    // protected $with = ['missions', 'transactions'];
    protected $with = ['source'];


    protected $fillable = [
        'source_type',
        'price'
    ];

    public function source()
    {
        return $this->morphTo('source');
    }


    // public function transactions()
    // {
    //     return $this->morphOne(Transaction::class, 'source_id', 'id');
    // }
    // public function one()
    // {
    //     var_dump($this->id);
    //     return $this->source_type;
    //     // return $this->missions() ?? $this->transactions();
    //     // return $this->source_type === 'transactions' ? $this->hasOne(Transaction::class, 'source_id', 'id') : $this->hasOne(Transaction::class, 'source_id', 'id');
    // }

}
