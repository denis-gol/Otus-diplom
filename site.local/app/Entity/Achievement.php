<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achievement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'achievement';

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
        return $this->belongsToMany(Student::class)->withPivot(['completed_date']);
    }

}
