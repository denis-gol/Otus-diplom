<?php


namespace App\Calculators;


use App\Entity\Student;
use App\Entity\Task;

interface ICalculatorInterface
{
    public function calc(Student $student, Task $task);
}
