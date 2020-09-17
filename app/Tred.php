<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tred extends Model
{
    public $fillable = ['tred_item'];
    public $id_tred;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function topic()
    {
    	return $this->belongsTo(Topic::class, 'content_id', 'id');
    }

    public function commun()
    {
        return $this->hasMany(Commun::class, 'tred_id', 'id');
    }

    public function quote()
    {
        return $this->hasMany(Commun::class, 'tred_id', 'id');
    }

    public function readId()
    {
        return $id_tred = $this->id;  
        dd(5);
    }
}

