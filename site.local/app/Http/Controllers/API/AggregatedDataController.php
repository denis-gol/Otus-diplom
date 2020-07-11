<?php

namespace App\Http\Controllers\API;

use App\Entity\Student;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;

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
        if (Student::where('id', $id)->doesntExist()) {
            return response()->json([
                'error' => 'user not found',
            ], 404);
        }

        $date = new DateTime();


        // return stub
        return response()->json([
            'your_id' => $id,
            'date' => $date,
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

        // return stub
        return response()->json([
            'your_id' => $id,
        ]);
    }
}
