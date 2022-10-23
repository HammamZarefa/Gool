<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
class Match extends Model
{

    protected $guarded = ['id'];
    protected  $table = "matches";

    public function country(){
        return $this->belongsTo(Country::class, 'country_key', 'country_key');
    }

    public function league(){
        return $this->belongsTo(League::class, 'league_key', 'league_key');
    }
}
