<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PokemonController;

Route::get('/', function () {   
    return view('welcome');
});

Route::get('/Skibidi', function () {
    return view('Skibidi');
});

Route::get('/calculator', [CalculatorController::class, 'index']);
Route::post('/calculator', [CalculatorController::class, 'calculate'])->name('calculator.calculate');

Route::resource('/products', ProductController::class);

Route::get('/pokemon', [PokemonController::class, 'index'])->name('pokemon.index');
Route::post('/pokemon', [PokemonController::class, 'search'])->name('pokemon.search');