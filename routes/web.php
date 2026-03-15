<?php

use App\Http\Controllers\LearningController;
use App\Http\Controllers\PolymorphicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PolymorphicController::class, 'index'])->name('index');

Route::get('/control-panel', [LearningController::class, 'controlPanel']);

Route::post('/products', [LearningController::class, 'storeProduct']);
Route::post('/articles', [LearningController::class, 'storeArticle']);
Route::post('/tags', [LearningController::class, 'storeTag']);

Route::post('/comments', [LearningController::class, 'storeComment']);

Route::post('/attach-tag', [LearningController::class, 'attachTag']);

Route::post('/detach-tag', [LearningController::class, 'detachTag']);
Route::delete('/comments/{comment}', [LearningController::class, 'deleteComment']);