<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Skill
 * @package App\Entity
 *
 * @property mixed tasks
 * @property mixed id
 *
 */
class Skill extends Model
{

    const TALKATIVE_TYPE_CODE = 'talkative';
    const OTHER_TYPE_CODE = 'other_code';

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
        return $this->belongsToMany(Student::class, 'student_skill')->withPivot(['points']);
    }

    /**
     * @return BelongsToMany
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_skill')->withPivot(['percent_for_skill']);
    }

    /**
     * @return BelongsToMany
     */
    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(SkillLevel::class);
    }
}
