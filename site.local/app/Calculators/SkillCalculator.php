<?php


namespace App\Calculators;


use App\Entity\Skill;
use App\Entity\Student;
use App\Entity\Task;

class SkillCalculator implements ICalculatorInterface
{
    /** @var array */
    protected $skillsPoints = [];

    public function calc(Student $student, Task $task)
    {
        /** @var Skill $skill */
        foreach ($task->skills as $skill) {
            $this->skillsPoints[$skill->id] = 0;
            $skill->tasks()->each(function ($skillTask) use ($skill, $student) {
                /** @var Task $studentTask */
                $studentTask = $student->tasks()->newQuery()->where('id', $skillTask->id)->first();
                if ($studentTask instanceof Task) {
                    $this->skillsPoints[$skill->id] = $this->skillsPoints[$skill->id] + ($studentTask->pivot->point * $skillTask->pivot->percent_for_skill / 100);
                }
            });
        }

        foreach ($this->skillsPoints as $key => $skillPoints) {
            $skillExist = $student->skills()->newQuery()->where('id', $key)->exists();
            if ($skillExist) {
                $student->skills()->updateExistingPivot($key, [
                    'points' => $skillPoints,
                ]);
            } else {
                $student->skills()->attach($key, [
                    'points' => $skillPoints,
                ]);
            }
        }
    }

}
