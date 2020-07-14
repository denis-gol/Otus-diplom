<?php


namespace App\Listeners;


use App\Entity\Achievement;
use App\Entity\Skill;
use App\Events\AchievementCalculatorEvent;

/**
 * Class AchievementExcellentTalkative
 * @package App\Listeners
 */
class AchievementExcellentTalkative
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

        $allTalkativeTasks = Skill::query()
                            ->join('task_skill', 'skill.id', 'task_skill.skill_id')
                            ->join('task', 'task.id', 'task_skill.task_id')
                            ->where('type', Skill::TALKATIVE_TYPE_CODE)
                            ->get()->count();

        if ($talkativeTasksCount === $allTalkativeTasks) {
            $excellentTalkative = Achievement::query()->where('discriminator', self::class)->first();

            $student->achievements()->newQuery()->where('id', $excellentTalkative->id)->existsOr(function () use ($student, $excellentTalkative) {
                $student->achievements()->attach($excellentTalkative->id, [
                    'completed_date' => now(),
                ]);
            });
        }

    }
}
