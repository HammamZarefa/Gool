<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $guarded = ['id'];
    protected $table = 'leagues';

    public function country(){
        return $this->belongsTo(Country::class, 'country_key', 'country_key');
    }

    public function matches(){
        return $this->hasMany(Match::class, 'league_key', 'league_key');
    }
}
