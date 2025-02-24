<?php

use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// User Controller | One to One
Route::prefix('users')->group(function() {
    Route::post('', [UserController::class, 'createUser']);
    Route::get('{id}', [UserController::class, 'get']);
});
Route::post('profiles', [UserController::class, 'createProfile']);


// CategoryProduct Controller | One to Many
Route::prefix('categories')->group(function() {
    Route::post('', [CategoryProductController::class, 'createCategory']);
    Route::get('{id}/products', [CategoryProductController::class, 'get']);
});
Route::post('products', [CategoryProductController::class, 'createProduct']);


// StudentSubject Controller | Many to Many
Route::prefix('students')->group(function() {
    Route::post('', [StudentSubjectController::class, 'createStudent']);
    Route::get('{id}/subjects', [StudentSubjectController::class, 'get']);
});

Route::post('subjects', [StudentSubjectController::class, 'createSubject']);
Route::post('student-subjects', [StudentSubjectController::class, 'enrollStudentSubject']);