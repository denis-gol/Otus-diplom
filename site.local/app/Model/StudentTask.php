<?php


namespace App\Model;


use DateTime;

class StudentTask
{
    /** @var int */
    protected $student_id;

    /** @var int */
    protected $task_id;

    /** @var int */
    protected $point;

    /** @var DateTime */
    protected $completed_date;

    /**
     * @return int
     */
    public function getStudentId(): int
    {
        return $this->student_id;
    }

    /**
     * @param int $student_id
     * @return StudentTask
     */
    public function setStudentId(int $student_id): StudentTask
    {
        $this->student_id = $student_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return $this->task_id;
    }

    /**
     * @param int $task_id
     * @return StudentTask
     */
    public function setTaskId(int $task_id): StudentTask
    {
        $this->task_id = $task_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPoint(): int
    {
        return $this->point;
    }

    /**
     * @param int $point
     * @return StudentTask
     */
    public function setPoint(int $point): StudentTask
    {
        $this->point = $point;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCompletedDate(): DateTime
    {
        return $this->completed_date;
    }

    /**
     * @param DateTime $completed_date
     * @return StudentTask
     */
    public function setCompletedDate(DateTime $completed_date): StudentTask
    {
        $this->completed_date = $completed_date;
        return $this;
    }

}
