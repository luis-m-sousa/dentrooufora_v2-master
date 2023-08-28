<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VotacaoController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/candidato',                       [CandidatoController::class, 'index'])->name('candidato.index')->middleware('auth');
Route::get('/candidato/create',                [CandidatoController::class, 'create'])->name('candidato.create')->middleware('auth');
Route::post('/candidato/create',               [CandidatoController::class, 'store'])->name('candidato.store')->middleware('auth');
Route::get('/candidato/edit/{id}',             [CandidatoController::class, 'edit'])->name('candidato.edit')->middleware('auth');
Route::post('/candidato/update/{id}',          [CandidatoController::class, 'update'])->name('candidato.update')->middleware('auth');
Route::get('/candidato/delete/{id}',           [CandidatoController::class, 'delete'])->name('candidato.delete')->middleware('auth');

Route::get('/categoria',                       [CategoriaController::class, 'index'])->name('categoria.index')->middleware('auth');
Route::get('/categoria/create',                [CategoriaController::class, 'create'])->name('categoria.create')->middleware('auth');
Route::post('/categoria/create',               [CategoriaController::class, 'store'])->name('categoria.store')->middleware('auth');
Route::get('/categoria/edit/{id}',             [CategoriaController::class, 'edit'])->name('categoria.edit')->middleware('auth');
Route::post('/categoria/update/{id}',          [CategoriaController::class, 'update'])->name('categoria.update')->middleware('auth');
Route::get('/categoria/delete/{id}',           [CategoriaController::class, 'delete'])->name('categoria.delete')->middleware('auth');

Route::get('/votacao',                         [VotacaoController::class, 'index'])->name('votacao.index')->middleware('auth');
Route::get('/votacao/create',                  [VotacaoController::class, 'create'])->name('votacao.create')->middleware('auth');
Route::post('/votacao/create',                 [VotacaoController::class, 'store'])->name('votacao.store')->middleware('auth');
Route::get('/votacao/edit/{id}',               [VotacaoController::class, 'edit'])->name('votacao.edit')->middleware('auth');
Route::post('/votacao/update/{id}',            [VotacaoController::class, 'update'])->name('votacao.update')->middleware('auth');
Route::get('/votacao/delete/{id}',             [VotacaoController::class, 'delete'])->name('votacao.delete')->middleware('auth');










Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
