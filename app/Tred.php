<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tred extends Model
{
    public $fillable = ['tred_item'];
    use SoftDeletes;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function topics()
    {
    	return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    public function boards()
    {
        return $this->hasMany(Board::class, 'tred_id', 'id');
    }
}

