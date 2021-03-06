<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Board
 * @package App
 */
class Board extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    public $fillable = ['board_item'];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * SoftDelete child with parent
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($boards)
        {
            foreach ($boards->answers()->get() as $answer)
            {
                $answer->delete();
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
