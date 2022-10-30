<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = "bet";

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
