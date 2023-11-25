<!-- resources/views/listarCC.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Contas Correntes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <h2 class="mb-4">Listagem de Contas Correntes</h2>
    <a href="{{ route('listaClientesContaCorrente') }}" class="btn btn-primary mb-3">Voltar para Painel de Contas</a>
    @if(count($contasCorrentes) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id da CC</th>
                <th scope="col">id da Conta</th>
                <th scope="col">Nome do Cliente</th>
                <th scope="col">Limite de Crédito</th>
                <th scope="col">Tarifa Mensal</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contasCorrentes as $contaCorrente)
            <tr>
                <td>{{$contaCorrente->id}}</td>
                <td>{{$contaCorrente->ID_Conta}}</td>
                <td>{{ $contaCorrente->NomeCliente }}</td>
                <td>{{ number_format($contaCorrente->LimiteCredito, 2, ',', '.') }}</td>
                <td>{{ number_format($contaCorrente->TarifaMensal, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('deletarContaCorrente', ['id' => $contaCorrente->id]) }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar a conta corrente?')">Deletar Conta Corrente</a>
                    <a href="{{ route('editarContaCorrente', ['id' => $contaCorrente->id]) }}" class="btn btn-warning">Editar Dados</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-3">Nenhuma conta corrente encontrada.</p>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>