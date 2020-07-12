<?php

namespace App\Http\Controllers\API;

use App\Entity\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class AggregatedData
 * Формирование и возврат агрегированных данных
 *
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
     * @return JsonResponse
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
            ->select(['task_student.point', 'task.max_point'])
            ->where('student_id', $id)
            ->leftJoin('task', 'task.id', '=', 'task_student.task_id')
            ->get()
            ->toArray();

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
     * вернуть суммарное значение по всем навыкам студента
     * route: /api/getData/Student/{id}/skillLevels
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function skillLevels(Request $request, int $id)
    {
        // проверка существования студента
        // @todo выкинуть это в middleware
        // @todo добавить проверки остальных полей, валидация полей
        if (Student::where('id', $id)->doesntExist()) {
            return response()->json([
                'error' => 'user not found',
            ], 404);
        }

        /**
            SELECT ss.skill_id, s.name, sum(points)
            FROM task_student ts
            LEFT JOIN student_skill ss ON ts.student_id = ss.student_id
            LEFT JOIN skill s on ss.skill_id = s.id
            WHERE ts.student_id = {id}
            GROUP BY ss.skill_id, s.name;
         */
        $studentTaskQuery = DB::table('task_student')
            ->select(['student_skill.skill_id', 'skill.name', DB::raw('sum(student_skill.points)')])
            ->where('task_student.student_id', $id)
            ->leftJoin('student_skill', 'task_student.student_id', '=', 'student_skill.student_id')
            ->leftJoin('skill', 'skill.id', '=', 'student_skill.skill_id')
            ->groupBy(['student_skill.skill_id', 'skill.name'])
            ->get()
            ->toArray();

        // добавляем округление к значениям массива
        $responseArray = array_map(function ($item) {
            $item->sum = round($item->sum, 2);
            return $item;
        },
            $studentTaskQuery);

        return response()->json([
            'student_id' => $id,
            'skill_levels' => $responseArray,
        ]);
    }

    /**
     * Вернуть список достижений студента
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function achievements(Request $request, int $id)
    {
        // проверка существования студента
        // @todo выкинуть это в middleware
        // @todo добавить проверки остальных полей, валидация полей
        if (Student::where('id', $id)->doesntExist()) {
            return response()->json([
                'error' => 'user not found',
            ], 404);
        }

        $studentAchievementQuery = DB::table('student')
            ->select(['achievement.id', 'achievement.name', 'achievement.description', 'student_achievement.completed_date'])
            ->where('student_id', $id)
            ->leftJoin('student_achievement', 'student.id', '=', 'student_achievement.student_id')
            ->leftJoin('achievement', 'student_achievement.achievement_id', '=', 'achievement.id')
            ->get()
            ->toArray();

        return response()->json([
            'student_id' => $id,
            'count_of_achievements' => count($studentAchievementQuery),
            'achievement_list' => $studentAchievementQuery,
        ]);

    }
}
