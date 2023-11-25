<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ContaCorrente;
use App\Models\Conta;
use Illuminate\Support\Facades\DB;


class ContaCorrenteController extends Controller
{
    public function criarContaCorrente($id)
    {
        $conta = Conta::find($id);
        return view('criarCC', compact('conta'));
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

        return redirect()->route('listarContasCorrentes')->with('success', 'Conta corrente criada com sucesso!');
    }

    public function listarContasCorrentes()
    {
        $contasCorrentes = DB::table('contas_corrente')
            ->join('contas', 'contas_corrente.ID_Conta', '=', 'contas.id')
            ->join('clientes', 'contas.ID_Cliente', '=', 'clientes.id')
            ->select('contas_corrente.*', 'clientes.Nome as NomeCliente')
            ->get();
        return view('listarCC', compact('contasCorrentes'));
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
