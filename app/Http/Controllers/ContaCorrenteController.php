<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ContaCorrente;

class ContaCorrenteController extends Controller
{
    public function criarContaCorrente($id)
    {
        $cliente = Cliente::find($id);
        return view('criarCC', compact('cliente'));
    }

    public function salvarContaCorrente(Request $request, $id)
    {
        // Lógica para salvar a conta corrente
    }

    public function editarContaCorrente($id)
    {
        $cliente = Cliente::find($id);
        return view('editarCC', compact('cliente'));
    }

    public function atualizarContaCorrente(Request $request, $id)
    {
        // Lógica para atualizar a conta corrente
    }
}
