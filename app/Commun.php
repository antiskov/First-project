<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commun extends Model
{
    public $fillable = ['commun_item'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function treds()
    {
    	return $this->belongsTo(Tred::class, 'tred_id', 'id');
    }
}
