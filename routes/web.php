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

Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/candidatura/{user}/{interview}', [InterviewController::class, 'candidancie'])->name('candidatura');
Route::get('/entrevista/{interview}', [InterviewController::class, 'show'])->name('show.entrevista');
Route::get('/candidatos', [UserController::class, 'candidates'])->name('candidatos');


//el recluter crea la empresa y se le asigna el company_id
Route::get('/empresa/crear', [CompanyController::class, 'recluter'])->name('empresa.recluter.crear');
Route::post('/empresa/relucter/crear', [CompanyController::class, 'recluter_store'])->name('empresa.recluter.store');

Route::get('/aplicar/{interview}', [InterviewController::class, 'apply'])->name('aplicar');
Route::post('/aplicar/store/user', [InterviewController::class, 'store_user'])->name('aplicar.store.user');

Route::get('/pregunta/{question}', [InterviewController::class, 'question'])->name('aplicar_pregunta');
Route::post('/store/pregunta', [InterviewController::class, 'next_question'])->name('responder_pregunta');
Route::post('/store/pregunta/final', [InterviewController::class, 'last_question'])->name('responder_pregunta.final');
Route::get('/aplicar/final/{interview}', [InterviewController::class, 'goodbye'])->name('aplicar.final');
Route::post('guardar-video', [InterviewController::class, 'save_video'])->name('guardar_video');