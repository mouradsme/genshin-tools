<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return app()->make(App\Http\Controllers\DashboardController::class)->index();
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Regions
    Route::resource('regions', App\Http\Controllers\Admin\RegionController::class);
    
    // World Quests
    Route::resource('world-quests', App\Http\Controllers\Admin\WorldQuestController::class);
    
    // Users
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});

// User-facing routes
Route::get('/regions', [App\Http\Controllers\RegionController::class, 'index'])->name('regions.index');
Route::get('/regions/{region}', [App\Http\Controllers\RegionController::class, 'show'])->name('regions.show');
Route::get('/world-quests', [App\Http\Controllers\WorldQuestController::class, 'index'])->name('world-quests.index');
Route::get('/world-quests/{worldQuest}', [App\Http\Controllers\WorldQuestController::class, 'show'])->name('world-quests.show');

require __DIR__.'/auth.php';
