<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Conta;

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
            'CPF' => 'required|string|size:11|unique:clientes,CPF,'.$id.',id',
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
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->route('listaClientesComContas')->with('error', 'Cliente não encontrado.');
        }

        // Obtenha o ID da conta associada ao cliente
        $contaId = $cliente->ID_Conta;

        // Remova a relação entre o cliente e a conta
        $cliente->ID_Conta = null;
        $cliente->save();

        // Se houver uma conta associada ao cliente, delete a conta
        if ($contaId) {
            $conta = Conta::find($contaId);

            if ($conta) {
                $conta->delete();
            }
        }

        // Delete o cliente
        $cliente->delete();

        return redirect()->route('listaClientesComContas')->with('success', 'Cliente deletado com sucesso.');
    }
}
