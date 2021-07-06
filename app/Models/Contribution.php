<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $with = ['transactions', 'organisation'];


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
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'source');
    }
    public function delete()
    {
        $res = parent::delete();
        if ($res == true) {
            $relation = $this->transactions()->getParent();
            $trans = Transaction::where('source_id', $relation->id)->first();
            $trans->delete();
        }
    }
}
