<?php


namespace App\Calculators;


use App\Entity\Student;

interface ICalculatorInterface
{
    public function calc(Student $student);
}
