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
        // Realize um INNER JOIN com a tabela clientes para obter informações do cliente associado à conta
        $cliente = Cliente::join('contas', 'clientes.ID_Conta', '=', 'contas.id')
            ->where('contas.id', $id)
            ->first(); // Selecione o primeiro resultado

        return view('criarCC', compact('conta', 'cliente'));
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

    public function deletarContaCorrente($id)
    {
        $contaCorrente = ContaCorrente::find($id);

        if (!$contaCorrente) {
            return redirect()->route('listarContasCorrentes')->with('error', 'Conta corrente não encontrada.');
        }

        $contaCorrente->delete();

        return redirect()->route('listarContasCorrentes')->with('success', 'Conta corrente deletada com sucesso.');
    }

    public function editarContaCorrente($id)
    {
        $contaCorrente = ContaCorrente::find($id);

        if (!$contaCorrente) {
            return redirect()->route('listarCC')->with('error', 'Conta Corrente não encontrada.');
        }

        return view('alterarCC', compact('contaCorrente'));
    }

    public function atualizarContaCorrente(Request $request, $id)
    {
        $request->validate([
            'limiteCredito' => 'required|numeric',
            'tarifaMensal' => 'required|numeric',
        ]);

        $contaCorrente = ContaCorrente::find($id);

        if (!$contaCorrente) {
            return redirect()->route('listarContasCorrentes')->with('error', 'Conta Corrente não encontrada.');
        }

        $contaCorrente->LimiteCredito = $request->input('limiteCredito');
        $contaCorrente->TarifaMensal = $request->input('tarifaMensal');
        $contaCorrente->save();

        return redirect()->route('listarContasCorrentes')->with('success', 'Conta Corrente atualizada com sucesso.');
    }
}
