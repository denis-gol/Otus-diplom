<?php


namespace App\Model;


use DateTime;

class StudentTaskFactory
{
    /**
     * @param array $rawStudentTask
     * @return StudentTask
     */
    public function make(array $rawStudentTask): StudentTask
    {
        $task = new StudentTask();
        $task->setStudentId($rawStudentTask['student_id'])
            ->setTaskId($rawStudentTask['task_id'])
            ->setPoint($rawStudentTask['point'])
            ->setCompletedDate(DateTime::createFromFormat("Y-m-d", $rawStudentTask['completed_date']));
        return $task;
    }
}
