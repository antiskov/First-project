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
    public function tred()
    {
        return $this->belongsTo(Tred::class);
    }
}
