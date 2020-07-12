<?php


namespace App\Handlers;


use App\Calculator\AchievementCalculator;
use App\Calculator\SkillCalculator;
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
     * @param StudentTask $studentTask
     */
    public function handle(StudentTask $studentTask)
    {

        $student = Student::query()->where('id', $studentTask->getStudentId())->get()->first();
        $task = Task::query()->where('id', $studentTask->getTaskId())->get()->first();
        if ($student instanceof Student && $task instanceof Task) {
            $this->processTask($student, $studentTask);
            $this->skillCalculator->calc($student, $task);
            $this->achievementCalculator->calc($student, $task);

//            logs()->info("Task {$task->getTaskId()} successful added to Student {$task->getStudentId()}");
        }
    }

    protected function processTask(Student $student, StudentTask $studentTask): void
    {
        $taskExist = $student->tasks()->newQuery()->where('id', $studentTask->getTaskId())->exists();
        if ($taskExist) {
            $student->tasks()->updateExistingPivot($studentTask->getTaskId(), [
                'point' => $studentTask->getPoint(),
                'completed_date' => $studentTask->getCompletedDate()
            ]);
        } else {
            $student->tasks()->attach($studentTask->getTaskId(), [
                'point' => $studentTask->getPoint(),
                'completed_date' => $studentTask->getCompletedDate()
            ]);
        }

    }

}
