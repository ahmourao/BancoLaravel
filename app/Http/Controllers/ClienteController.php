<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Conta;
use Illuminate\Support\Facades\Log;
use App\Models\ContaCorrente;
use App\Models\ContaPoupanca;

class ClienteController extends Controller
{
    /**
     * Exibe o formulário do cliente.
     *
     * @return \Illuminate\View\View
     */
    public function formularioCliente()
    {
        return view('clientes');
    }

    /**
     * Processa o formulário e salva o cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvarCliente(Request $request)
    {
        $request->validate([
            'Nome' => 'required',
            'CPF' => 'required',
        ]);

        Cliente::create([
            'Nome' => $request->input('Nome'),
            'CPF' => $request->input('CPF'),
            'Endereco' => $request->input('Endereco'),
            'Telefone' => $request->input('Telefone'),
        ]);

        return redirect()->route('listaClientesComContas')->with('success', 'Cliente salvo com sucesso!');
    }

    public function listarClientesComContas()
    {
        $clientes = Cliente::leftJoin('contas', 'clientes.id', '=', 'contas.ID_Cliente')
            ->select('clientes.*', 'contas.TipoConta', 'contas.Saldo')
            ->get();

        return view('listaClientes', ['clientes' => $clientes]);
    }

    public function editar($id)
    {
        $cliente = Cliente::find($id);
        return view('editarCliente', ['cliente' => $cliente]);
    }

    public function atualizar(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'Nome' => 'required|string|max:255',
            'CPF' => 'required|string|size:11|unique:clientes,CPF,' . $id . ',id',
            'Endereco' => 'nullable|string|max:255',
            'Telefone' => 'nullable|string|max:20',
        ]);

        // Atualização do cliente
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->route('listaClientesComContas')->with('error', 'Cliente não encontrado.');
        }

        $cliente->update([
            'Nome' => $request->input('Nome'),
            'CPF' => $request->input('CPF'),
            'Endereco' => $request->input('Endereco'),
            'Telefone' => $request->input('Telefone'),
        ]);

        return redirect()->route('listaClientesComContas')->with('success', 'Cliente atualizado com sucesso.');
    }

    public function deletar($id)
    {
        try {
            // Encontrar o cliente pelo ID
            $cliente = Cliente::find($id);

            // Verificar se o cliente existe
            if (!$cliente) {
                return redirect()->route('listaClientesComContas')->with('error', 'Cliente não encontrado.');
            }

            // Obter o ID da conta associada ao cliente
            $contaId = $cliente->ID_Conta;

            // Remover a referência do cliente na tabela contas
            $cliente->ID_Conta = null;
            $cliente->save();

            // Verificar se o cliente possui conta
            if ($contaId) {
                // Verificar se a conta está associada a contas_corrente
                $contaCorrente = ContaCorrente::where('ID_Conta', $contaId)->first();

                // Verificar se a conta está associada a contas_poupanca
                $contaPoupanca = ContaPoupanca::where('ID_Conta', $contaId)->first();

                // Remover registros na tabela contas_corrente se existirem
                if ($contaCorrente) {
                    $contaCorrente->delete();
                }

                // Remover registros na tabela contas_poupanca se existirem
                if ($contaPoupanca) {
                    $contaPoupanca->delete();
                }

                // Encontrar a conta associada ao cliente
                $conta = Conta::find($contaId);

                // Verificar se a conta existe
                if ($conta) {
                    // Remover a conta
                    $conta->delete();
                }
            }

            // Remover o cliente
            $cliente->delete();

            // Registrar mensagem de sucesso no log
            Log::info("Cliente {$id} deletado com sucesso.");

            return redirect()->route('listaClientesComContas')->with('success', 'Cliente deletado com sucesso.');
        } catch (\Exception $e) {
            // Registrar mensagem de erro no log
            Log::error("Erro durante a exclusão do cliente {$id}: {$e->getMessage()}");

            return redirect()->route('listaClientesComContas')->with('error', $e->getMessage());
        }
    }

    // PÁGINA PAINEL DE CONTROLE DE CONTAS
    public function listarClientesContaCorrente()
    {
        // Busque os clientes que têm conta corrente ou conta poupança
        $clientesComContas = Cliente::join('contas', 'clientes.ID_Conta', '=', 'contas.id')
            ->whereNotNull('contas.TipoConta') // Garante que apenas clientes com contas são incluídos
            ->get();

        return view('listaDeContas', compact('clientesComContas'));
    }
}
