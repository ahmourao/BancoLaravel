<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes com conta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <h2 class="mb-4">Painel de Controle de Contas</h2>
    <a href="{{ route('listaClientesComContas') }}" class="btn btn-primary mb-3">Ir para Painel de Cadastro</a>
    <a href="{{ route('listarContasCorrentes') }}" class="btn btn-primary mb-3">Lista de clientes com CC</a>
    @if(count($clientesComContas) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id Conta</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Tipo de Conta</th>
                <th scope="col">Saldo</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientesComContas as $cliente)
            <tr>
                <td>{{$cliente->id}}</td>
                <td>{{ $cliente->Nome }}</td>
                <td>{{ $cliente->CPF }}</td>
                @if ($cliente->conta)
                <td>{{ $cliente->conta->TipoConta }}</td>
                <td>{{ $cliente->conta->Saldo }}</td>
                <td>
                    @if ($cliente->conta->TipoConta === 'Conta Corrente')
                    <a href="{{ route('criarContaCorrente', ['id' => $cliente->conta->id]) }}" class="btn btn-success">Criar Conta Corrente</a>
                    @elseif ($cliente->conta->TipoConta === 'Conta Poupança')
                    <a href="{{ route('criarContaPoupanca', ['id' => $cliente->conta->id]) }}" class="btn btn-success">Criar Conta Poupança</a>
                    @endif

                    <a href="{{ route('deletarConta', ['id' => $cliente->id]) }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar a conta?')">Deletar Conta</a>
                </td>
                @else
                <td>Sem conta associada</td>
                <td>N/A</td>
                <td>
                    <a href="{{ route('criarContaCorrente', ['id' => $cliente->id]) }}" class="btn btn-success">Criar Conta Corrente</a>
                    <a href="{{ route('deletarConta', ['id' => $cliente->id]) }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar a conta?')">Deletar Conta</a>
                    
                    <a href="{{ route('criarContaPoupanca', ['id' => $cliente->id]) }}" class="btn btn-success">Criar Conta Poupança</a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-3">Nenhum cliente com conta encontrado.</p>
    @endif


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>