<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProfileController;
use App\Models\Alumno;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('alumnos', AlumnoController::class);
Route::get('/alumnos/criterios/{alumno}', function (Alumno $alumno){
    return view('alumnos.criterios', ['alumno' => $alumno],);
})->name('alumnos.criterios');



require __DIR__.'/auth.php';
