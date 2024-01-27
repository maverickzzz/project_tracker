<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectOwnerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceLogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGroupController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);

    // Route::get('/register', [RegisterController::class, 'index'])->name('register');
    // Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/select-company', [CompanyController::class, 'select_company']);
    Route::post('/select-company', function (\Illuminate\Http\Request $request) {
        session()->put('company_id', $request->input('company.id'));
        session()->put('company_name', $request->input('company.name'));
        session()->put('usergroup_id', UserUsergroupCompany::where('user_id', auth()->user()->id)->where('company_id', session('company_id'))->first()->usergroup_id ?? 0);
        session()->put('is_administrator', auth()->user() && auth()->user()->id === 1);
//        dd($request->input('company'), session('company_id'), session('company_name'));
        return redirect('/');
    });

//    Route::get('/', [ProjectController::class, 'index']);
    Route::middleware(['has_company_id'])->group(function() {
        Route::get('/', function () {
            return Inertia::render('Dashboard/Index');
        });

        Route::get('/project-owners/{owner_id}/projects', [ProjectController::class, 'index'])->middleware('roles:project_owners');

        Route::get('/projects/{project_id}/services', [ServiceController::class, 'index']);
        Route::get('/projects/{project_id}/services/{service_id}/edit', [ServiceController::class, 'edit']);
        Route::get('/projects/{project_id}/services/{service_id}/logs', [ServiceController::class, 'logs']);
        Route::get('/projects/{project_id}/payments', [PaymentController::class, 'index']);
        Route::get('/projects/{project_id}/payments/create', [PaymentController::class, 'create']);
        Route::get('/projects/{project_id}/service-logs/create', [ServiceLogController::class, 'create']);

        Route::resource('/projects', ProjectController::class);
        Route::resource('/project-owners', ProjectOwnerController::class);
        Route::resource('/payments', PaymentController::class);
        Route::resource('/services', ServiceController::class);
        Route::resource('/service-logs', ServiceLogController::class);

        Route::middleware(['roles:administration_users'])->group(function () {
            Route::get('/users/{user_id}/impersonate', [UserController::class, 'impersonate']);
            Route::get('/users/leave', [UserController::class, 'leave']);
            Route::get('/users/set-access', [UserController::class, 'setAccess']);


            Route::post('/users/set-access', [UserController::class, 'saveAccess']);

            Route::resource('/users', UserController::class);
        });

        Route::resource('/usergroups', UserGroupController::class)->middleware('roles:administration_user_groups');
        Route::resource('/companies', CompanyController::class)->middleware('roles:administration_companies');

        Route::get('/settings', function () {
            return Inertia::render('Dashboard/Administration/Settings');
        });
    });

    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/change-password', [UserController::class, 'change_password']);
    Route::post('/change-password', [UserController::class, 'do_change_password']);
});

Route::fallback(function () {
    return redirect('/');
});
