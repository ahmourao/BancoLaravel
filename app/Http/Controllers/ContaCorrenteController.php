<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ContaCorrente;
use App\Models\Conta;

class ContaCorrenteController extends Controller
{
    public function criarContaCorrente($id)
    {
        $cliente = Cliente::find($id);
        return view('criarCC', compact('cliente'));
    }

    public function salvarContaCorrente(Request $request, $idConta)
    {
        $request->validate([
            'LimiteCredito' => 'required|numeric',
            'TarifaMensal' => 'required|numeric',
            // Adicione outras validações conforme necessário
        ]);

        // Encontre a conta
        $conta = Conta::find($idConta);

        // Verifique se a conta existe
        if (!$conta) {
            return redirect()->route('listaClientesComContas')->with('error', 'Conta não encontrada.');
        }

        // Crie a conta corrente
        ContaCorrente::create([
            'ID_Conta' => $conta->id,
            'LimiteCredito' => $request->input('LimiteCredito'),
            'TarifaMensal' => $request->input('TarifaMensal'),
        ]);

        return redirect()->route('listaClientesComContas')->with('success', 'Conta corrente criada com sucesso!');
    }


    // public function editarContaCorrente($id)
    // {
    //     $cliente = Cliente::find($id);
    //     return view('editarCC', compact('cliente'));
    // }

    // public function atualizarContaCorrente(Request $request, $id)
    // {
    //     // Lógica para atualizar a conta corrente
    // }
}
