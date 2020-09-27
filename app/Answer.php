<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Answer
 * @package App
 */
class Answer extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    public $fillable = ['answer_item'];

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
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
