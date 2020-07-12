<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::apiResource('student', 'API\StudentController');
Route::apiResource('group', 'API\GroupController');
Route::apiResource('course', 'API\CourseController');
Route::apiResource('lesson', 'API\LessonController');
Route::apiResource('skill', 'API\SkillController');
Route::apiResource('skill_level', 'API\SkillLevelController');
Route::apiResource('task', 'API\TaskController');
Route::apiResource('achievement', 'API\AchievementController');

/**
 * получить задание, выполненное студентом
 */
Route::prefix('interaction')->group(function () {
    Route::post('sendTask', 'API\InteractionController@sendTask');
});

/**
 * вернуть агрегированные данные
 */
// средний балл студента по всем пройденным занятиям
Route::get('getData/Student/{id}/gradePointAverage', 'API\AggregatedDataController@gradePointAverage')
    ->name('aggregated.gradePointAverage');

// суммарное значение по всем навыкам студента
Route::get('getData/Student/{id}/skillLevels', 'API\AggregatedDataController@skillLevels')
    ->name('aggregated.skillLevels');

// список достижений по студенту
Route::get('getData/Student/{id}/achievements', 'API\AggregatedDataController@achievements')
    ->name('aggregated.achievements');
