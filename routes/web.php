<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\QuestionController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'empresas' => CompanyController::class,
    'entrevistas' => InterviewController::class,
    'cuestionario' => QuestionController::class,
    //'posts' => PostController::class,
]);



Route::get('/admin/dashboard', function () {return view('admin.dashboard');});
