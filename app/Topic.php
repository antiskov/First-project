<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public $fillable = ['topic'];
    public $table = 'contents';
    public $id_topic;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function treds()
    {
    	return $this->hasMany(Tred::class, 'content_id', 'id');
    }

    public function commun()
    {
        return $this->hasMany(Commun::class, 'content_id', 'id');
    }

    public function readId()
    {
        return $id_topic = $this->id;   
    }
}
