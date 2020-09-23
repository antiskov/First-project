<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tred extends Model
{
    public $fillable = ['tred_item'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function topics()
    {
    	return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    public function communs()
    {
        return $this->hasMany(Commun::class, 'tred_id', 'id');
    }
}

