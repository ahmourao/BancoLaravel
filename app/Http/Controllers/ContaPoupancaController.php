<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaPoupanca;
use Illuminate\Support\Facades\DB;

class ContaPoupancaController extends Controller
{
    public function criarContaPoupanca($id)
    {
        // Aqui você pode passar dados adicionais para a view, se necessário

        return view('criarContaPoupanca', ['idConta' => $id]);
    }

    public function salvarContaPoupanca(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'taxaJuros' => 'required|numeric',
            'dataVencimento' => 'required|date',
        ]);

        // Crie a conta poupança associada à conta
        ContaPoupanca::create([
            'ID_Conta' => $id,
            'TaxaJuros' => $request->taxaJuros,
            'DataVencimento' => $request->dataVencimento,
        ]);

        // Redirecione com uma mensagem de sucesso
        return redirect()->route('listarContasPoupancas')->with('success', 'Conta Poupança criada com sucesso.');
    }

    public function listarContasPoupancas()
    {
        $contasPoupanca = DB::table('contas_poupanca')
            ->join('contas', 'contas_poupanca.ID_Conta', '=', 'contas.id')
            ->join('clientes', 'contas.ID_Cliente', '=', 'clientes.id')
            ->select('contas_poupanca.*', 'clientes.Nome as NomeCliente')
            ->get();

        return view('listarCP', compact('contasPoupanca'));
    }

    public function deletarContaPoupanca($id)
    {
        $contaPoupanca = ContaPoupanca::find($id);

        if (!$contaPoupanca) {
            return redirect()->route('listarContasPoupancas')->with('error', 'Conta Poupança não encontrada.');
        }

        $contaPoupanca->delete();

        return redirect()->route('listarContasPoupancas')->with('success', 'Conta Poupança deletada com sucesso.');
    }

    public function editarContaPoupanca($id)
    {
        $contaPoupanca = ContaPoupanca::find($id);

        if (!$contaPoupanca) {
            return redirect()->route('listarContasPoupancas')->with('error', 'Conta Poupança não encontrada.');
        }

        return view('editarContaPoupanca', compact('contaPoupanca'));
    }

    public function atualizarContaPoupanca(Request $request, $id)
    {
        $contaPoupanca = ContaPoupanca::find($id);

        if (!$contaPoupanca) {
            return redirect()->route('listarContasPoupancas')->with('error', 'Conta Poupança não encontrada.');
        }

        // Validação dos dados do formulário
        $request->validate([
            'taxaJuros' => 'required|numeric',
            'dataVencimento' => 'required|date',
        ]);

        // Atualização dos dados da Conta Poupança com base nos dados do formulário
        $contaPoupanca->TaxaJuros = $request->taxaJuros;
        $contaPoupanca->DataVencimento = $request->dataVencimento;
        $contaPoupanca->save();

        return redirect()->route('listarContasPoupancas')->with('success', 'Dados da Conta Poupança atualizados com sucesso.');
    }
}
