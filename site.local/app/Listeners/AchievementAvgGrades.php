<?php

namespace App\Listeners;


use App\Entity\Achievement;
use App\Events\AchievementCalculatorEvent;
use App\Utils\GradeUtils;

class AchievementAvgGrades
{

    /** @var GradeUtils */
    protected $gradeUtils;

    /**
     * AchievementAvgGrades constructor.
     * @param GradeUtils $gradeUtils
     */
    public function __construct(GradeUtils $gradeUtils)
    {
        $this->gradeUtils = $gradeUtils;
    }

    /**
     * Handle the event.
     *
     * @param  AchievementCalculatorEvent  $event
     * @return void
     */
    public function handle(AchievementCalculatorEvent $event)
    {
        $student = $event->getStudent();
        $currentAvgGrade = $this->gradeUtils->getAverageGradesByStudentID($student->id);

        Achievement::query()
            ->where('threshold', '<=', $currentAvgGrade)
            ->where('discriminator', self::class)
            ->each(function ($achieve) use ($student){
            $student->achievements()->newQuery()->where('id', $achieve->id)->existsOr(function () use ($student, $achieve) {
                $student->achievements()->attach($achieve->id, [
                    'completed_date' => now(),
                ]);
            });
        });

    }
}
