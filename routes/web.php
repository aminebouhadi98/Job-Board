<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PublicJobController;

/*
|--------------------------------------------------------------------------
| Pagina iniziale
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Redirect dinamico dopo login
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) return redirect('/login');

    return match ($user->role) {
        'company' => redirect()->route('company.dashboard'),
        'candidate' => redirect()->route('candidate.dashboard'),
        'admin' => redirect()->route('admin.jobs.index'),
        default => abort(403),
    };
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Dashboard azienda e candidato
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::view('/company/dashboard', 'company.dashboard')->name('company.dashboard');
    Route::view('/candidate/dashboard', 'candidate.dashboard')->name('candidate.dashboard');
});

/*
|--------------------------------------------------------------------------
| Rotte gestione annunci (SOLO AZIENDA) → /company/jobs/*
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'company'])->prefix('company')->group(function () {
    Route::resource('jobs', JobController::class)->names([
        'index' => 'company.jobs.index',
        'create' => 'company.jobs.create',
        'store' => 'company.jobs.store',
        'edit' => 'company.jobs.edit',
        'update' => 'company.jobs.update',
        'destroy' => 'company.jobs.destroy',
        'show' => 'company.jobs.show', // se mai servisse anche in admin
    ]);
});

/*
|--------------------------------------------------------------------------
| Candidature ai job (SOLO CANDIDATO)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'candidate'])->group(function () {
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply');
});

/*
|--------------------------------------------------------------------------
| Rotte pubbliche per consultare offerte (accessibili a tutti)
|--------------------------------------------------------------------------
*/
Route::get('/jobs', [PublicJobController::class, 'index'])->name('public.jobs.index');
Route::get('/jobs/{job}', [PublicJobController::class, 'show'])->name('public.jobs.show');

Route::middleware(['auth', 'company'])->prefix('company')->group(function () {
    Route::resource('jobs', JobController::class)->names([
        'index' => 'company.jobs.index',
        'create' => 'company.jobs.create',
        'store' => 'company.jobs.store',
        'edit' => 'company.jobs.edit',
        'update' => 'company.jobs.update',
        'destroy' => 'company.jobs.destroy',
        'show' => 'company.jobs.show',
    ]);

    // Rotta per vedere le candidature ricevute
    Route::get('/jobs/{job}/applications', [\App\Http\Controllers\CompanyApplicationController::class, 'index'])
        ->name('company.jobs.applications.index');
});
Route::put('/jobs/{job}/applications/{application}', [\App\Http\Controllers\CompanyApplicationController::class, 'update'])
    ->name('company.jobs.applications.update');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/jobs', [\App\Http\Controllers\AdminJobModerationController::class, 'index'])->name('admin.jobs.index');
    Route::put('/jobs/{job}/approve', [\App\Http\Controllers\AdminJobModerationController::class, 'approve'])->name('admin.jobs.approve');
});
