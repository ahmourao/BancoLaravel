<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContaController;

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