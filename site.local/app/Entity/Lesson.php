<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Lesson
 * @package App\Entity
 */
class Lesson extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson';

    /** @var array */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
//    public function course(): BelongsTo
//    {
//        return $this->belongsTo(Course::class);
//    }

    /**
     * @return HasMany
     */
//    public function tasks(): HasMany
//    {
//        return $this->hasMany(Task::class);
//    }
}
