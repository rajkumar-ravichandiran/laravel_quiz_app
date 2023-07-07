<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Email Verification Routes
Auth::routes(['verify' => true]);

Route::get('/user/inactive', function () {
    return view('auth.approval');
})->name('approval.inactive');

Route::group(['middleware' => ['auth','verified','active']], function () {
	Route::get('/start-quiz', 'App\Http\Controllers\QuizController@startQuiz')->name('start.quiz');
	Route::resource('quiz', 'App\Http\Controllers\QuizController');
	Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
	Route::get('/settings', 'App\Http\Controllers\SettingsController@index')->name('settings.index');
	Route::put('/settings', 'App\Http\Controllers\SettingsController@update')->name('settings.update');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::resource('categories', 'App\Http\Controllers\CategoryController');
	Route::resource('questions', 'App\Http\Controllers\QuestionController');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
Route::get('/user/{id}/{status}', 'App\Http\Controllers\UserController@manualApproval')->name('user.approval');
Route::get('/question/{id}/{status}', 'App\Http\Controllers\QuestionController@manualApproval')->name('question.approval');

