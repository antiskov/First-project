<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public $fillable = ['topic_item'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function treds()
    {
    	return $this->hasMany(Tred::class, 'topic_id', 'id');
    }
}
