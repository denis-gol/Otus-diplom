<?php

namespace App\Http\Controllers\API;

use App\Entity\Student;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $students = Student::all();
        $students->each(function ($student) {
            $student->user;
        });

        return response()->json([
            'students' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'maintenance mode',
        ], 503);

        if (is_array($request->all())
        && count($request->all()) == 3
        ) {

            /** @todo валидация так не работает(( */
            $validatedData = $request->validate([
                'first_name' => 'required|size:66',
                'last_name' => 'required',
                'user_id' => 'required|integer|gt:0',
            ]);

            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $user = $request->input('user');

            // проверка существования пользователя
            if (User::where('id', $user['id'])->exists()) {
                $student_id = Student::create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'user_id' => $user['id'],
                ]);
            } else {
                return response()->json([
                    'error' => 'user not found',
                ], 404);
            }

            return response()->json([
                'message' => 'success',
                'student_id' => $student_id->id,
            ]);
        } else {
            return response()->json([
                'error' => 'incorrect data',
            ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        /** @var Student $student */
        $student = Student::findOrFail($id);
        $student->user;
        return response()->json([
            'student' => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        // проверка существования студента
        if (Student::whereId($id)->doesntExist()) {
            return response()->json([
                'error' => 'student not found',
            ], 404);
        }

        // проверка существования пользователя
        if (!empty($data['user_id'])) {
            if (User::whereId($data['user_id'])->doesntExist()) {
                return response()->json([
                    'error' => 'user not found',
                ], 404);
            }
        }

        $res = Student::whereId($id)->update($data);

        return response()->json([
            'message' => 'success',
            'student_id' => $id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        return response()->json([
            'message' => 'maintenance mode',
        ], 503);

        // проверка существования студента
        if (Student::whereId($id)->doesntExist()) {
            return response()->json([
                'error' => 'student not found',
            ], 418);
        }

        $result = Student::findOrFail($id)->delete();

        if ($result) {
            return response()->json([
                'message' => 'success',
                'student_id' => $id,
            ]);
        } else {
            return response()->json([
                'message' => 'failed deleting',
            ], 418);
        }
    }

}
