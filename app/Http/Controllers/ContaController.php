<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Cliente;
use App\Models\ContaCorrente;
use App\Models\ContaPoupanca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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

        // Verifique se o cliente existe
        if (!$cliente) {
            return redirect()->route('listaClientesComContas')->with('error', 'Cliente não encontrado.');
        }
    
        // Verifique se o cliente possui uma conta associada
        if ($cliente->conta) {
            // Passe o ID da conta para a view
            $contaId = $cliente->conta->id;
            return view('editarConta', compact('cliente', 'contaId'));
        } else {
            return redirect()->route('listaClientesComContas')->with('error', 'Cliente sem conta associada.');
        }
    }

    public function atualizarConta(Request $request, $id)
    {
        // Valide os dados do formulário
        $request->validate([
            'TipoConta' => 'required|string|max:255',
            'Saldo' => 'required|regex:/^\d+([\.,]\d{1,2})?$/',
        ]);

        // Encontre a conta
        $conta = Conta::find($id);

        // Verifique se a conta existe
        if (!$conta) {
            return redirect()->route('listaClientesComContas')->with('error', 'Conta não encontrada.');
        }

        // Substitua vírgulas por pontos no saldo
        $saldo = str_replace([',', '.'], '.', $request->input('Saldo'));

        // Atualize os atributos da conta
        $conta->update([
            'TipoConta' => $request->input('TipoConta'),
            'Saldo' => $saldo,
        ]);

        return redirect()->route('listaClientesComContas')->with('success', 'Dados da conta atualizados com sucesso.');
    }


    public function deletarConta($id)
    {
        // Iniciar uma transação
        DB::beginTransaction();

        try {
            // Encontrar a conta pelo ID
            $conta = Conta::find($id);

            // Verificar se a conta existe
            if (!$conta) {
                throw new \Exception('Conta não encontrada.');
            }

            // Encontrar registros relacionados na tabela clientes
            $clientes = DB::table('clientes')->where('ID_Conta', $id)->get();

            // Deletar registros relacionados na tabela clientes
            foreach ($clientes as $cliente) {
                $clienteID = $cliente->id;

                // Encontrar registros relacionados na tabela contas_corrente
                $contaCorrente = ContaCorrente::where('ID_Conta', $id)->first();

                // Deletar registros relacionados na tabela contas_corrente
                if ($contaCorrente) {
                    $contaCorrente->delete();
                }

                // Encontrar registros relacionados na tabela contas_poupanca
                $contaPoupanca = ContaPoupanca::where('ID_Conta', $id)->first();

                // Deletar registros relacionados na tabela contas_poupanca
                if ($contaPoupanca) {
                    $contaPoupanca->delete();
                }

                // Deletar registros relacionados na tabela clientes
                DB::table('clientes')->where('id', $clienteID)->update(['ID_Conta' => null]);
            }

            // Deletar a conta
            $conta->delete();

            // Commit da transação
            DB::commit();

            // Registrar mensagem de sucesso no log
            Log::info("Conta {$id} deletada com sucesso.");

            return redirect()->route('listaClientesComContas')->with('success', 'Conta deletada com sucesso.');
        } catch (\Exception $e) {
            // Se ocorrer um erro, rollback da transação
            DB::rollback();

            // Registrar mensagem de erro no log
            Log::error("Erro durante a exclusão da conta {$id}: {$e->getMessage()}");

            return redirect()->route('listaClientesComContas')->with('error', $e->getMessage());
        }
    }
}
