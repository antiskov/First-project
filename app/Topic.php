<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    public $fillable = ['topic_item'];
    use SoftDeletes;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function treds()
    {
    	return $this->hasMany(Tred::class, 'topic_id', 'id');
    }
}
