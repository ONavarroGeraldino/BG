<?php
use App\Http\Controllers\JsonUploadController;
use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    

Route::middleware(['auth'])->group(function () {
     Route::get('/upload-json', [JsonUploadController::class, 'create'])->name('upload.json.create');
     Route::post('/upload-json', [JsonUploadController::class, 'store'])->name('upload.json.store');
    //  Route::get('/sensors', [SensorController::class, 'index'])->name('sensors.index');
  
});

// Route::middleware(['auth'])->get('/sensors', function () {
//     return view('sensors');
// })->name('sensors.index');
Route::middleware(['auth'])->get('/sensors', [SensorController::class, 'index'])->name('sensors.index');
Route::post('/sensors', [SensorController::class, 'index']);

// Route::middleware(['auth'])->get('/sensors', [SensorController::class, 'index'])->name('sensors.index');

require __DIR__.'/auth.php';
