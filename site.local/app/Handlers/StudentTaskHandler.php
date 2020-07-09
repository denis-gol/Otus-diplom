<?php


namespace App\Handlers;


use App\Calculators\AchievementCalculator;
use App\Calculators\SkillCalculator;
use App\Entity\Student;
use App\Entity\Task;
use App\Model\StudentTask;

class StudentTaskHandler
{
    /** @var SkillCalculator */
    protected $skillCalculator;

    /** @var AchievementCalculator */
    protected $achievementCalculator;

    /**
     * StudentTaskHandler constructor.
     * @param SkillCalculator       $skillCalculator
     * @param AchievementCalculator $achievementCalculator
     */
    public function __construct(SkillCalculator $skillCalculator, AchievementCalculator $achievementCalculator)
    {
        $this->skillCalculator = $skillCalculator;
        $this->achievementCalculator = $achievementCalculator;
    }

    /**
     * @param StudentTask $task
     */
    public function handle(StudentTask $task): void
    {
        $student = Student::query()->where('id', $task->getStudentId())->get()->first();
        $isTaskExist = Task::query()->where('id', $task->getTaskId())->exists();
        if ($student instanceof Student && $isTaskExist) {
            $this->processTask($student, $task);
            $this->skillCalculator->calc($student);
            $this->achievementCalculator->calc($student);

//            logs()->info("Task {$task->getTaskId()} successful added to Student {$task->getStudentId()}");
        }
    }

    protected function processTask(Student $student, StudentTask $task): void
    {
        $student->tasks()->attach($task->getTaskId(), [
            'point' => $task->getPoint(),
            'completed_date' => $task->getCompletedDate()
        ]);
    }

}
