<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\{ UHealthcareController, SurveySubmissionController } ;

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

Route::middleware('guest')->get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::get('/dashboard', fn ()=> Inertia::render('Dashboard') )->name('dashboard');
    Route::get('/personal', fn ()=> Inertia::render('account/personal') )->name('personal');
    Route::get('/security', fn ()=> Inertia::render('account/security') )->name('security');
    Route::get('/healthcare', fn ()=> Inertia::render('account/healthcare') )->name('healthcare');
    Route::get('/survey', fn ()=> Inertia::render('account/survey') )->name('survey');
    Route::get('/projectshome', fn ()=> Inertia::render('ProjectsHome') )->name('projectshome');
    Route::get('/proposed', fn ()=> Inertia::render('project/proposed') )->name('proposed');
    Route::get('/current', fn ()=> Inertia::render('project/current') )->name('current');
    Route::get('/archieved', fn ()=> Inertia::render('project/archieved') )->name('archieved');
    Route::get('/project', fn ()=> Inertia::render('project/project') )->name('project');
    Route::get('/allprojects', fn ()=> Inertia::render('project/allprojects') )->name('allproject');
    Route::get('/roster', fn ()=> Inertia::render('project/roster') )->name('roster');


    Route::get('/surveyProjects', [SurveySubmissionController::class, 'show']);
    Route::post('/surveyProjects', [SurveySubmissionController::class, 'store']);
    Route::get('/emailShow', [RegisteredUserController::class, 'show']);
    Route::get('/showInfo', [RegisteredUserController::class, 'showPersonalInfo']);
    Route::post('/password-update', [RegisteredUserController::class, 'PasswordUpdate']);
    Route::post('/personal', [RegisteredUserController::class, 'update']);
    Route::get('/healthcareInfo', [UHealthcareController::class, 'show']);
    Route::post('/healthcare', [UHealthcareController::class, 'update']);
});

require __DIR__.'/auth.php';
