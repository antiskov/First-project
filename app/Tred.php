<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tred extends Model
{
    public $fillable = ['tred_item'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function topic()
    {
    	return $this->belongsTo(Topic::class, 'content_id', 'id');
    }
}
