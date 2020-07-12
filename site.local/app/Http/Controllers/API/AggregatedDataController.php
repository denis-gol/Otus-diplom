<?php

namespace App\Http\Controllers\API;

use App\Entity\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class AggregatedData
 * Формирование и возврат агрегированных данных
 * @package App\Http\Controllers\API
 */
class AggregatedDataController extends Controller
{
    /**
     * Вернуть средний балл студента по всем пройденным занятиям
     *
     * route: /api/getData/Student/{id}/gradePointAverage
     *
     * @param Request $request
     * @param int $id student_id
     */
    public function gradePointAverage(Request $request, int $id)
    {
        // проверка существования студента
        // @todo выкинуть это в middleware
        // @todo добавить проверки остальных полей, валидация полей
        if (Student::where('id', $id)->doesntExist()) {
            return response()->json([
                'error' => 'user not found',
            ], 404);
        }

        $studentTaskQuery = DB::table('task_student')
            ->where('student_id', $id)
            ->leftJoin('task', 'task.id', '=', 'task_student.task_id')
            ->get(['task_student.point', 'task.max_point'])->toArray();

        // вычислить приведенный балл по каждому заданию (достигнутый уровень/максимальный уровень баллов)
        $reducedPoints = array_map(function($item) {
            return round($item->point / $item->max_point, 2);
        }, $studentTaskQuery);

        // вычислить среднее значение по всем баллам
        $averagePoints = round(array_sum($reducedPoints) / count($reducedPoints), 2);

        return response()->json([
            'student_id' => $id,
            'average_points' => $averagePoints,
            'number_completed_tasks' => count($reducedPoints)
        ]);
    }

    /**
     * вернуть количество пройденных занятий по всем курсам
     * route: /api/getData/Student/{id}/numberOfLessons
     *
     * @param Request $request
     * @param int $id
     */
    public function numberOfLessons(Request $request, int $id)
    {

        // @todo
        // получить из БД количество заданий, выполненных этим студентом
        // вернуть количество

        // return stub
        return response()->json([
            'your_id' => $id,
        ]);
    }
}
