<?php


namespace App\Calculator;


use App\Entity\Student;
use App\Entity\Task;
use App\Events\AchievementCalculatorEvent;

class AchievementCalculator implements ICalculatorInterface
{
    public function calc(Student $student, Task $task)
    {
        AchievementCalculatorEvent::dispatch($student);
    }

}
