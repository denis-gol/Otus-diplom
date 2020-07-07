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
