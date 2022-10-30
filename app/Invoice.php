<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    public function bets()
    {
        return $this->hasMany(Bet::class,'invoice_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
