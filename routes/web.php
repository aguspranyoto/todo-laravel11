<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('todo');
Route::post('/', [TodoController::class, 'store'])->name('todo.post');
Route::put('/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/{id}', [TodoController::class, 'destroy'])->name('todo.delete');
