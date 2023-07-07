<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
|--------------------------------------------------------------------------
| API Routes  V1 /api/v1/
|--------------------------------------------------------------------------
|
*/

//V1
Route::prefix('v1/')->name('v1.')->group(function () {
    //quiz
    Route::prefix('quiz')->name('quiz.')->group(function () {
        Route::get('/get-questions', 'App\Http\Controllers\API\v1\QuizController@getQuestions')->name('getQuestions');
        Route::get('/get-categories', 'App\Http\Controllers\API\v1\QuizController@getCategories')->name('getCategories');
        Route::post('/complete-quiz', 'App\Http\Controllers\API\v1\QuizController@completeQuiz')->name('completeQuiz');
    });
});