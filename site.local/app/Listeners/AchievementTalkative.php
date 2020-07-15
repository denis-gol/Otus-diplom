<?php


namespace App\Listeners;


use App\Entity\Achievement;
use App\Entity\Skill;
use App\Events\AchievementCalculatorEvent;

/**
 * Class AchievementTalkative
 * @package App\Listeners
 */
class AchievementTalkative
{
    /**
     * Handle the event.
     *
     * @param  AchievementCalculatorEvent  $event
     * @return void
     */
    public function handle(AchievementCalculatorEvent $event)
    {
        $student = $event->getStudent();

        $talkativeTasksCount = $student->tasks()
            ->getQuery()
            ->join('task_skill', 'task.id', 'task_skill.task_id')
            ->join('skill', 'skill.id', 'task_skill.skill_id')
            ->where('skill.type', Skill::TALKATIVE_TYPE_CODE)
            ->get()->count();

        Achievement::query()
            ->where('threshold', '<=', $talkativeTasksCount)
            ->where('discriminator', self::class)
            ->each(function ($achieve) use ($student) {
                $student->achievements()->newQuery()->where('id', $achieve->id)->existsOr(function () use ($student, $achieve) {
                    $student->achievements()->attach($achieve->id, [
                        'completed_date' => now(),
                    ]);
                });
            });
    }
}
