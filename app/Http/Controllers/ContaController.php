<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    public function formularioConta()
    {
        return view('conta');
    }

    public function salvarConta(Request $request)
    {
        $request->validate([
            'ID_Cliente' => 'required|numeric',
            'TipoConta' => 'required',
            'Saldo' => 'required|numeric',
            // Adicione outras validações conforme necessário
        ]);

        // Crie a conta
        $conta = Conta::create([
            'ID_Cliente' => $request->input('ID_Cliente'),
            'TipoConta' => $request->input('TipoConta'),
            'Saldo' => $request->input('Saldo'),
        ]);

        // Atualize o ID_Conta do cliente associado a esta conta
        $cliente = Cliente::find($request->input('ID_Cliente'));
        $cliente->ID_Conta = $conta->id;
        $cliente->save();

        return redirect()->route('listaClientesComContas')->with('success', 'Conta salva com sucesso!');
    }

    public function editarConta($id)
    {
        $cliente = Cliente::find($id);

        return view('editarConta', compact('cliente'));
    }

    public function atualizarConta(Request $request, $id)
    {
        // Valide os dados do formulário
        $request->validate([
            'TipoConta' => 'required|string|max:255',
            'Saldo' => 'required|numeric',
        ]);

        // Encontre o cliente
        $cliente = Cliente::find($id);

        // Verifique se o cliente possui uma conta
        if (!$cliente->conta) {
            return redirect()->route('listaClientesComContas')->with('error', 'Cliente sem conta associada.');
        }

        // Atualize os atributos da conta
        $cliente->conta->update([
            'TipoConta' => $request->input('TipoConta'),
            'Saldo' => $request->input('Saldo'),
        ]);

        return redirect()->route('listaClientesComContas')->with('success', 'Conta do cliente atualizada com sucesso.');
    }
}
