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
            'Saldo' => 'required|regex:/^\d+(\,\d{1,2})?$/',
            // Adicione outras validações conforme necessário
        ]);

        // Substitua vírgulas por pontos no saldo
        $saldo = str_replace(',', '.', $request->input('Saldo'));

        // Encontre o cliente
        $cliente = Cliente::find($request->input('ID_Cliente'));

        // Se o cliente já tiver uma conta, atualize o saldo
        if ($cliente->conta) {
            $cliente->conta->update([
                'TipoConta' => $request->input('TipoConta'),
                'Saldo' => $saldo,
            ]);
        } else {
            // Caso contrário, crie uma nova conta
            $conta = Conta::create([
                'ID_Cliente' => $request->input('ID_Cliente'),
                'TipoConta' => $request->input('TipoConta'),
                'Saldo' => $saldo,
            ]);

            // Atualize o ID_Conta do cliente associado a esta conta
            $cliente->ID_Conta = $conta->id;
            $cliente->save();
        }

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
            'Saldo' => 'required|regex:/^\d+([\.,]\d{1,2})?$/',
        ]);

        // Encontre o cliente
        $cliente = Cliente::find($id);

        // Verifique se o cliente possui uma conta
        if (!$cliente->conta) {
            return redirect()->route('listaClientesComContas')->with('error', 'Cliente sem conta associada.');
        }

        // Substitua vírgulas por pontos no saldo
        $saldo = str_replace([',', '.'], '.', $request->input('Saldo'));

        // Atualize os atributos da conta
        $cliente->conta->update([
            'TipoConta' => $request->input('TipoConta'),
            'Saldo' => $saldo,
        ]);

        return redirect()->route('listaClientesComContas')->with('success', 'Conta do cliente atualizada com sucesso.');
    }
}
