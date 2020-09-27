<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tred
 * @package App
 */
class Tred extends Model
{
    /**
     *
     */
    use SoftDeletes;

    /**
     * @var string[]
     */
    public $fillable = ['tred_item'];
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
    	return $this->belongsTo(Topic::class);
    }

    /**
     * SoftDelete child with parent
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boards()
    {
        return $this->hasMany(Board::class);
    }
}

