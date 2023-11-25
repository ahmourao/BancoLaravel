<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\ContaCorrenteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formulario-cliente', [ClienteController::class, 'formularioCliente'])->name('formularioCliente');
Route::post('/salvar-cliente', [ClienteController::class, 'salvarCliente'])->name('salvarCliente');

Route::get('/formulario-conta', [ContaController::class, 'formularioConta'])->name('formularioConta');
Route::post('/salvar-conta', [ContaController::class, 'salvarConta'])->name('salvarConta');

Route::get('/lista-clientes', [ClienteController::class, 'listarClientesComContas'])->name('listaClientesComContas');

Route::get('/editar-cliente/{id}', [ClienteController::class, 'editar'])->name('editarCliente');
Route::get('/editar-conta/{id}', [ContaController::class, 'editarConta'])->name('editarConta');
Route::get('/deletar-cliente/{id}', [ClienteController::class, 'deletar'])->name('deletarCliente');
Route::put('/atualizar-cliente/{id}', [ClienteController::class, 'atualizar'])->name('atualizarCliente');
Route::put('/atualizar-conta/{id}', [ContaController::class, 'atualizarConta'])->name('atualizarConta');


Route::get('/lista-clientes-conta-corrente', [ClienteController::class, 'listarClientesContaCorrente'])->name('listaClientesContaCorrente');

// Rotas para contas correntes
Route::get('/criar-conta-corrente/{id}', [ContaCorrenteController::class, 'criarContaCorrente'])->name('criarContaCorrente');
Route::post('/salvar-conta-corrente/{idConta}', [ContaCorrenteController::class, 'salvarContaCorrente'])->name('salvarContaCorrente');

// Route::get('/editar-conta-corrente/{id}', [ContaCorrenteController::class, 'editarContaCorrente'])->name('editarContaCorrente');

// Rotas para contas poupança
// Route::get('/criar-conta-poupanca/{id}', [ContaController::class, 'criarContaPoupanca'])->name('criarContaPoupanca');
// Route::get('/editar-conta-poupanca/{id}', [ContaController::class, 'editarContaPoupanca'])->name('editarContaPoupanca');