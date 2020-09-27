<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tred extends Model
{
    use SoftDeletes;
    public $fillable = ['tred_item'];
    protected $dates = ['deleted_at'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function topic()
    {
    	return $this->belongsTo(Topic::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($treds)
        {
            foreach ($treds->boards()->get() as $board)
            {
                $board->delete();
            }
        });
    }

    public function boards()
    {
        return $this->hasMany(Board::class);
    }
}

