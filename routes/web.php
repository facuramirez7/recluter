<?php

use App\Http\Controllers\UserController;
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
    'usuarios' => UserController::class,
    'empresas' => CompanyController::class,
    'entrevistas' => InterviewController::class,
    'cuestionarios' => QuestionController::class
]);

Route::get('/admin/dashboard', function () {return view('admin.dashboard');});
Route::get('/candidatos', [UserController::class, 'candidates'])->name('candidatos');





Route::get('/aplicar/{interview}', [InterviewController::class, 'apply'])->name('aplicar');
Route::post('/aplicar/store/user', [InterviewController::class, 'store_user'])->name('aplicar.store.user');

Route::get('/pregunta/{question}', [InterviewController::class, 'question'])->name('aplicar_pregunta');