<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Topic extends Model
{
    public $fillable = ['topic'];
    public $table = 'contents';

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
