<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Topic
 * @package App
 */
class Topic extends Model
{
    use SoftDeletes;

    /**
     * SoftDelete child with parent
     */
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

    /**
     * @var string[]
     */
    public $fillable = ['topic_item'];
    /**
     * @var string[]
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function treds()
    {
    	return $this->hasMany(Tred::class, 'topic_id', 'id');
    }

}
