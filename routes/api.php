<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Serviços
Route::post('store', [ServicoController::class, 'store']);
Route::get('find/descricao', [ServicoController::class, 'pesquisarPorDescricao']);
Route::get('all',[ServicoController::class, 'retornarTodos']);
Route::get('find/nome', [ServicoController::class, 'pesquisarPorNome']);
Route::delete('delete/{id}', [ServicoController::class, 'excluir']);
Route::put('update', [ServicoController::class, 'update']);

//Clientes
Route::post('cliente/store', [ClienteController::class, 'store']);
Route::get('cliente/all', [ClienteController::class, 'retornarTodos']);
Route::post('cliente/find/nome', [ClienteController::class, 'pesquisarPorNome']);
Route::delete('cliente/delete/{id}', [ClienteController::class, 'excluir']);
Route::put('cliente/update', [ClienteController::class, 'update']);
Route::get('cliente/find/cpf', [ClienteController::class, 'pesquisarPorCpf']);
Route::get('cliente/find/celular', [ClienteController::class, 'pesquisarPorTelefone']);
Route::get('cliente/find/email', [ClienteController::class, 'pesquisarPorEmail']);

//Profissional
Route::post('profissional/store', [ProfissionalController::class, 'store']);
Route::get('profissional/all', [ProfissionalController::class, 'retornarTodos']);
Route::post('profissional/find/nome', [ProfissionalController::class, 'pesquisarPorNome']);
Route::delete('profissional/delete/{id}', [ProfissionalController::class, 'excluir']);
Route::put('profissional/update', [ProfissionalController::class, 'update']);
Route::get('profissional/find/cpf', [ProfissionalController::class, 'pesquisarPorCpf']);
Route::get('profissional/find/celular', [ProfissionalController::class, 'pesquisarPorTelefone']);
Route::get('profissional/find/email', [ProfissionalController::class, 'pesquisarPorEmail']);
