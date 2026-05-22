<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Sekarang ketika mengetik localhost:8000 langsung memanggil halaman To-Do List
Route::get('/', [TodoController::class, 'index'])->name('todos.index');

// Rute untuk memproses manipulasi data To-Do List (tanpa pelindung login)
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');