<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FastBettingTransaction extends Model
{
    use  SoftDeletes;
    protected $fillable = [
        'draw_amount',
        'user_id'
    ];
    protected $table = "fast_betting_transactions";

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
