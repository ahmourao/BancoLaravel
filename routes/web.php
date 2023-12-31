<?php

use App\Http\Controllers\ContaPoupancaController;
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

// PAINEL DE CONTROLE DE CADASTRO
Route::get('/lista-clientes', [ClienteController::class, 'listarClientesComContas'])->name('listaClientesComContas');

//CRUD DO CLIENTE E CONTA
Route::get('/editar-cliente/{id}', [ClienteController::class, 'editar'])->name('editarCliente');
Route::get('/editar-conta/{id}', [ContaController::class, 'editarConta'])->name('editarConta');
Route::get('/deletar-cliente/{id}', [ClienteController::class, 'deletar'])->name('deletarCliente');
Route::put('/atualizar-cliente/{id}', [ClienteController::class, 'atualizar'])->name('atualizarCliente');
Route::put('/atualizar-conta/{id}', [ContaController::class, 'atualizarConta'])->name('atualizarConta');
Route::get('/deletar-conta/{id}', [ContaController::class, 'deletarConta'])->name('deletarConta');

// PAINEL DE CONTROLE DE CONTAS
Route::get('/lista-clientes-conta-corrente', [ClienteController::class, 'listarClientesContaCorrente'])->name('listaClientesContaCorrente');



// Rotas para contas correntes
    // CRIAR CONTA CORRENTE
Route::get('/criar-conta-corrente/{id}', [ContaCorrenteController::class, 'criarContaCorrente'])->name('criarContaCorrente');
Route::post('/salvar-conta-corrente/{idConta}', [ContaCorrenteController::class, 'salvarContaCorrente'])->name('salvarContaCorrente');
    //ALTERAR E DELETAR
Route::get('/deletar-conta-corrente/{id}', [ContaCorrenteController::class, 'deletarContaCorrente'])->name('deletarContaCorrente');
Route::get('/editar-conta-corrente/{id}', [ContaCorrenteController::class, 'editarContaCorrente'])->name('editarContaCorrente');
Route::patch('/atualizar-conta-corrente/{id}', [ContaCorrenteController::class, 'atualizarContaCorrente'])->name('atualizarContaCorrente');
    // LISTAGEM DE CONTAS CORRENTES
Route::get('/listar-contas-correntes', [ContaCorrenteController::class, 'listarContasCorrentes'])->name('listarContasCorrentes');
// Route::get('/editar-conta-corrente/{id}', [ContaCorrenteController::class, 'editarContaCorrente'])->name('editarContaCorrente');




// Rotas para contas poupança
Route::get('/criar-conta-poupanca/{id}', [ContaPoupancaController::class, 'criarContaPoupanca'])->name('criarContaPoupanca');
Route::post('/salvar-conta-poupanca/{id}', [ContaPoupancaController::class, 'salvarContaPoupanca'])->name('salvarContaPoupanca');
Route::get('/listar-contas-poupanca', [ContaPoupancaController::class, 'listarContasPoupancas'])->name('listarContasPoupancas');
Route::get('/deletar-conta-poupanca/{id}', [ContaPoupancaController::class, 'deletarContaPoupanca'])->name('deletarContaPoupanca');
Route::get('/editar-conta-poupanca/{id}', [ContaPoupancaController::class, 'editarContaPoupanca'])->name('editarContaPoupanca');
Route::patch('/atualizar-conta-poupanca/{id}', [ContaPoupancaController::class, 'atualizarContaPoupanca'])->name('atualizarContaPoupanca');
// Route::get('/editar-conta-poupanca/{id}', [ContaController::class, 'editarContaPoupanca'])->name('editarContaPoupanca');