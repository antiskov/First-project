<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public $fillable = ['topic_item'];
    public $id_topic;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function tred()
    {
    	return $this->hasMany(Tred::class, 'topic_id', 'id');
    }

    public function readId()
    {
        return $id_topic = $this->id;
    }
}
