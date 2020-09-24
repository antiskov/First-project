<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    public $fillable = ['board_item'];
    use SoftDeletes;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function treds()
    {
    	return $this->belongsTo(Tred::class, 'tred_id', 'id');
    }
}
