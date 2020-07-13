<?php


namespace App\Utils;


use Illuminate\Support\Facades\DB;

/**
 * Class GradeUtils
 * @package App\Utils
 */
class GradeUtils
{

    /**
     * @param int $id
     * @return float
     */
    public function getAverageGradesByStudentID(int $id): float
    {
        $reducedPoints = $this->getReducedPoints($id);

        // вычислить среднее значение по всем баллам
        return (count($reducedPoints) > 0) ? round(array_sum($reducedPoints) / count($reducedPoints), 2) : 0;
    }

    /**
     * @param int $id
     * @return array|false[]|float[]
     */
    public function getReducedPoints(int $id)
    {
        $studentTaskQuery = DB::table('task_student')
            ->select(['task_student.point', 'task.max_point'])
            ->where('student_id', $id)
            ->leftJoin('task', 'task.id', '=', 'task_student.task_id')
            ->get()
            ->toArray();

        // вычислить приведенный балл по каждому заданию (достигнутый уровень/максимальный уровень баллов)
        return array_map(function($item) {
            return round($item->point / $item->max_point, 2);
        }, $studentTaskQuery);
    }
}
