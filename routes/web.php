<?php

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
//    Route::get('/', [ProjectController::class, 'index']);
    Route::get('/', function() {
        return Inertia::render('Dashboard/Index');
    });

    Route::get('/project-owners/{owner_id}/projects', [ProjectController::class, 'index']);

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

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user-groups', [UserGroupController::class, 'index']);

    Route::get('/settings', function () {
        return Inertia::render('Dashboard/Administration/Settings');
    });

    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::fallback(function () {
    return redirect('/');
});
