<?php

use App\Http\Controllers\AgendaController;
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
Route::post('store/servico', [ServicoController::class, 'store']);
Route::get('find/descricao', [ServicoController::class, 'pesquisarPorDescricao']);
Route::get('all/servico',[ServicoController::class, 'retornarTodos']);
Route::post('find/nome', [ServicoController::class, 'pesquisarPorNome']);
Route::delete('delete/{id}', [ServicoController::class, 'excluir']);
Route::put('update', [ServicoController::class, 'update']);
Route::get('servico/find/{id}', [ServicoController::class, 'pesquisarPorId']);

//Clientes
Route::post('cliente/store', [ClienteController::class, 'store']);
Route::get('cliente/all', [ClienteController::class, 'retornarTodos']);
Route::post('cliente/find/nome', [ClienteController::class, 'pesquisarPorNome']);
Route::delete('cliente/delete/{id}', [ClienteController::class, 'excluir']);
Route::put('cliente/update', [ClienteController::class, 'update']);
Route::get('cliente/find/cpf', [ClienteController::class, 'pesquisarPorCpf']);
Route::get('cliente/find/celular', [ClienteController::class, 'pesquisarPorTelefone']);
Route::get('cliente/find/email', [ClienteController::class, 'pesquisarPorEmail']);
Route::get('cliente/find/{id}', [ClienteController::class, 'pesquisarPorId']);
Route::post('cliente/atualizar/senha', [ClienteController::class, 'esqueciMinhaSenha']);
//Profissional
Route::post('profissional/store', [ProfissionalController::class, 'store']);
Route::get('profissional/all', [ProfissionalController::class, 'retornarTodos']);
Route::post('profissional/find/nome', [ProfissionalController::class, 'pesquisarPorNome']);
Route::delete('profissional/delete/{id}', [ProfissionalController::class, 'excluir']);
Route::put('profissional/update', [ProfissionalController::class, 'update']);
Route::get('profissional/find/cpf', [ProfissionalController::class, 'pesquisarPorCpf']);
Route::get('profissional/find/celular', [ProfissionalController::class, 'pesquisarPorTelefone']);
Route::get('profissional/find/email', [ProfissionalController::class, 'pesquisarPorEmail']);
Route::get('profissional/find/{id}', [ProfissionalController::class, 'pesquisarPorId']);

//Agendamento
Route::post('/profissional/agendamento',[AgendaController::class,'criarHorarioProfissional' ]);
Route::get('horarios/profissionais', [AgendaController::class, 'retornarTodos']);
Route::delete('agenda/delete/{id}',[AgendaController::class,'excluirHorario']);
Route::put('atualizar/horarios', [AgendaController::class,'updateHorarios']);
Route::get('agenda/find/horario/{id}', [AgendaController::class, 'pesquisarPorIdAgenda']);
Route::post('agenda/find/data', [AgendaController::class, 'pesquisarPorData']);
Route::post('agenda/find/data/{profissional_id}', [AgendaController::class, 'pesquisarPorDataDoProfissional']);

