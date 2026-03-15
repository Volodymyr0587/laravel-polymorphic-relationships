<?php

use App\Http\Controllers\PolymorphicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PolymorphicController::class, 'index'])->name('index');
