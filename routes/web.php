<?php

use App\Models\CafeUserComment;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\{BikeController,
    BikeItemsController,
    CafeUserCommentController,
    FundingController,
    GoalController,
    LeadershipTeamController,
    LocationController,
    ReferenceController,
    RiskManagementController,
    SafetyController,
    SocialMediaController,
    UHealthcareController,
    SurveySubmissionController,
    ResultsController,
    ProjectController,
    EventController,
    ProjectUserController,
    ApplicationController,
    UserAttendanceController};

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
Route::get('/', fn ()=> Inertia::render('project/allProjects') )->name('display-projects');

Route::middleware('guest')->get('/login-page', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('logo');

Route::get('/roster-confirmation/{email}/{project_slug}/{name}/{event_slug}', fn ()=> Inertia::render('project/rosterRegisterConfirmation') )->name('roster-confirmation');
Route::post('/roster-register-confirm', [EventController::class, 'RosterConfirm']);
Route::get('/projects', [ProjectController::class, 'projects']);
Route::get('/allproject', fn ()=> Inertia::render('project/allProjects') )->name('all-project');

Route::group(['middleware' => ['auth', 'verified']], function (){


    Route::get('/dashboard', fn ()=> Inertia::render('Dashboard') )->name('dashboard');

    Route::get('/plan', fn ()=> Inertia::render('Do/Projects') )->name('plan');

    Route::get('/personal', fn ()=> Inertia::render('account/personal') )->name('personal');
    Route::get('/security', fn ()=> Inertia::render('account/security') )->name('security');
    Route::get('/healthcare', fn ()=> Inertia::render('account/healthcare') )->name('healthcare');

//    Route::get('/projectshome', fn ()=> Inertia::render('ProjectsHome') )->name('projectshome');
    Route::get('/new-project', fn ()=> Inertia::render('project/newProject') )->name('new-project');
    Route::get('/proposed/{slug}', fn ()=> Inertia::render('project/proposed') )->name('proposed');
    Route::get('/archieved', fn ()=> Inertia::render('project/archieved') )->name('archieved');
    Route::get('/favourite-project/{slug?}', fn ()=> Inertia::render('project/project') )->name('favourite-project');
//    Route::get('/allproject', fn ()=> Inertia::render('project/allProjects') )->name('all-project');
    Route::get('/roster/{event_id}/{project_id}', fn ()=> Inertia::render('project/roster') )->name('roster');
    Route::get('/application', fn ()=> Inertia::render('project/application') )->name('application');
    Route::get('/roster-register/{event_id}/{project_id}', fn ()=> Inertia::render('project/rosterRegister') )->name('roster-register');
    Route::get('/roster-register-cycle/{event_id}', fn ()=> Inertia::render('project/rosterRegister') )->name('roster-register-cycle');
    Route::get('/roster-register-cafe/{event_id}', fn ()=> Inertia::render('project/rosterRegister') )->name('roster-register-cafe');
    Route::get('/project-leadership/leader/{slug}', fn ()=> Inertia::render('project/projectLeadership') )->name('project-leader');
    Route::get('/project-leadership/assistant/{slug}', fn ()=> Inertia::render('project/projectLeadership') )->name('project-assistant');
    Route::get('/project-leadership/application/{slug}', fn ()=> Inertia::render('project/projectLeadership') )->name('project-application');
    Route::get('/cycle/{event}', fn ()=> Inertia::render('project/cycle') )->name('cycle-project');
    Route::get('/cafe/{event}', fn ()=> Inertia::render('project/cafe') )->name('cafe-project');
    Route::get('/bike-project/{slug}', fn ()=> Inertia::render('project/bikeProject') )->name('bike-project');
    Route::get('/bike-project/{project_slug}/{bike_slug?}', fn ()=> Inertia::render('project/bikeProject') )->name('bike-project-edit');
    Route::get('/bike-all-projects/{slug}', fn ()=> Inertia::render('project/bikeAllProjects') )->name('bike-all-projects');
    Route::get('/question-first', fn ()=> Inertia::render('project/questionFirst') )->name('question-first');
    Route::get('/question-second', fn ()=> Inertia::render('project/questionSecond') )->name('question-second');
    Route::get('/question-third', fn ()=> Inertia::render('project/questionThird') )->name('question-third');
    Route::get('/applications-projects', fn ()=> Inertia::render('project/applications-projects') )->name('applications-projects');
/*
 * RegisteredUserController
 */
    Route::get('/showInfo', [RegisteredUserController::class, 'showPersonalInfo']);
    Route::get('/emailShow', [RegisteredUserController::class, 'show']);
    Route::post('/password-update', [RegisteredUserController::class, 'PasswordUpdate']);
    Route::post('/personal', [RegisteredUserController::class, 'update']);
/*
 * UHealthcareController
*/
    Route::get('/healthcareInfo', [UHealthcareController::class, 'show']);
    Route::post('/healthcare', [UHealthcareController::class, 'update']);
/*
 * ProjectController
 */
    Route::get('/project-names', [ProjectController::class, 'index']);
//    Route::get('/projects', [ProjectController::class, 'projects']);
    Route::get('/favourite-projects', [ProjectController::class, 'favouriteInfo'])->name('favourite_info');
    Route::get('/edit-favourite-projects/{slug?}', [ProjectController::class, 'editFavouriteInfo'])->name('favourite_info');
    Route::get('/project-events/{slug}', [ProjectController::class, 'events']);
    Route::get('/new-projects/{slug}', [ProjectController::class, 'show']);
    Route::get('/footer-project', [ProjectController::class, 'footer_project'])->name('footer-project');
    Route::get('/archieve-project', [ProjectController::class, 'showArchieve']);
    Route::post('/project-names', [ProjectController::class, 'store']);
    Route::post('/project-approve', [ProjectController::class, 'projectApprove']);
    Route::post('/archieve-project', [ProjectController::class, 'isarchieve']);
    Route::post('/un-archieve', [ProjectController::class, 'unarchieve']);
    Route::post('/favourite-project', [ProjectController::class, 'iskey']);
    Route::post('/update-project', [ProjectController::class, 'update']);
    Route::post('/approve-project', [ProjectController::class, 'approve']);
    Route::delete('/delete-project/{id}', [ProjectController::class, 'destroy']);
    Route::delete('/user-delete-project/{id}', [ProjectController::class, 'deleteUser']);
    Route::delete('/delete-a-project/{id}', [ProjectController::class, 'deleteProject']);
/*
*  ProjectUserController
*/
    Route::post('/user-project', [ProjectUserController::class, 'update']);
    Route::post('/roster-comment', [ProjectUserController::class, 'edit']);
    Route::post('/is-roster', [ProjectUserController::class, 'isRoster']);
/*
 *  EventController
*/
    Route::get('/event-info/{event_slug}/{project_slug}', [EventController::class, 'showInfo']);
    Route::post('/event-name', [EventController::class, 'store']);
    Route::post('/group-comment', [EventController::class, 'update']);
    Route::post('/roster-new', [EventController::class, 'rosterRegister']);
    Route::post('/add-participant', [EventController::class, 'addParticipant']);
    Route::get('/searchEmail/{search}', [EventController::class, 'findMail']);

    Route::get('/bike-show/{bike_slug?}', [GoalController::class, 'show']);

    Route::get('/cycle-info/{module}/{event}', [UserAttendanceController::class, 'show']);
    Route::post('/cycle-info', [UserAttendanceController::class, 'store']);
    Route::delete('/delete-participant/{id}', [UserAttendanceController::class, 'destroy']);

    Route::get('/bike-projects/{slug}', [BikeController::class, 'show']);
    Route::post('/bike-all-information', [BikeController::class, 'store']);

    Route::post('/user-comment', [CafeUserCommentController::class, 'store']);

    Route::get('/proposals-page-information/{slug?}', [LocationController::class, 'show']);
    Route::post('/location-information', [LocationController::class, 'store']);

    Route::post('/save-risk', [RiskManagementController::class, 'store']);

    Route::post('/safety-info', [SafetyController::class, 'store']);

    Route::post('/save-finance', [FundingController::class, 'store']);

    Route::post('/save-social', [SocialMediaController::class, 'store']);

    Route::post('/checked-names', [LeadershipTeamController::class, 'store']);

});

//Route::get('/project-names', [ProjectController::class, 'names']);
Route::get('/project-names', [ProjectController::class, 'allNames']);
Route::get('/project-all-names', [ProjectController::class, 'allNames']);
Route::get('/proposals/{slug?}', fn ()=> Inertia::render('project/proposals') )->name('proposals');

Route::get('/application', fn ()=> Inertia::render('project/application') )->name('application');
Route::get('/project/reference/{email}/{project_id}/{role_id}/{app_id}', fn ()=> Inertia::render('project/reference') )->name('references');
Route::get('/diet', fn ()=> Inertia::render('survey/diet') )->name('diet');
Route::get('/survey', fn ()=> Inertia::render('survey/survey') )->name('survey');
Route::get('/results', fn ()=> Inertia::render('survey/results') )->name('results');
Route::get('/surveys_home', fn ()=> Inertia::render('survey/surveys_home') )->name('surveys_home');
Route::get('/survey-projects', [SurveySubmissionController::class, 'show']);
Route::get('/surveyOptions', [SurveySubmissionController::class, 'index']);
Route::post('/name-edit', [SurveySubmissionController::class, 'update']);
Route::post('/check-project', [SurveySubmissionController::class, 'surveyProject']);
Route::post('/surveyProjects', [SurveySubmissionController::class, 'store']);
/*
*  ApplicationController
*/
Route::get('/applications-information', [ApplicationController::class, 'application']);
Route::get('/project-roles', [ApplicationController::class, 'show']);
Route::get('/application-answers/{id}/{project_slug}', [ApplicationController::class, 'answers']);
Route::post('/application-info', [ApplicationController::class, 'store']);
/*
 *  ReferenceController
*/
Route::post('/reference-form', [ReferenceController::class, 'store']);
/*
 *  ResultsController
*/
Route::get('/survey-results', [ResultsController::class, 'show']);

require __DIR__.'/auth.php';
