<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;
    public $fillable = ['topic_item'];
    protected $dates = ['deleted_at'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($topics)
        {
            foreach ($topics->treds()->get() as $tred)
            {
                $tred->delete();
            }
        });
    }

    public function treds()
    {
    	return $this->hasMany(Tred::class, 'topic_id', 'id');
    }

}
