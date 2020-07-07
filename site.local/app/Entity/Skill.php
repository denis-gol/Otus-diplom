<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'skill';

    /** @var array */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class)->withPivot(['point']);
    }

    /**
     * @return BelongsToMany
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class)->withPivot(['point']);
    }

    /**
     * @return HasMany
     */
    public function levels(): HasMany
    {
        return $this->hasMany(SkillLevel::class);
    }
}
