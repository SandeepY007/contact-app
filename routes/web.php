<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CropImageController;
use App\Http\Controllers\ImportContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/contacts', ContactsController::class);
    Route::post('/import-contacts', [ImportContactController::class, 'importContacts']);
    Route::get('/update-profile-image/{id}', [CropImageController::class, 'updateProfileImage']);
    Route::post('crop-image-upload-ajax', [CropImageController::class, 'cropImageUploadAjax']);
});
Route::get('/contact-profile-image/{filename}', function ($filename) {
    $path = public_path('upload/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    $mimeType = mime_content_type($path);
    return Response::file($path, ['Content-Type' => $mimeType]);
});
require __DIR__.'/auth.php';
