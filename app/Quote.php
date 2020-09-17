<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public $fillable = ['quote_item'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function topic()
    {
    	return $this->belongsTo(Topic::class, 'content_id', 'id');
    }

    public function tred()
    {
    	return $this->belongsTo(Tred::class, 'tred_id', 'id');
    }

    public function commun()
    {
    	return $this->belongsTo(Commun::class, 'commun_id', 'id');
    }
}
