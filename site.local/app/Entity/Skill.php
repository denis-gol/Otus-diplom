<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Skill
 * @package App\Entity
 */
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

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_skill')->withPivot(['point']);
    }

    /**
     * @return BelongsToMany
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_skill')->withPivot(['point']);
    }

    /**
     * @return BelongsToMany
     */
    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(SkillLevel::class);
    }
}
