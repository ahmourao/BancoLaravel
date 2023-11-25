<!-- resources/views/listarCP.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Contas Poupança</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <h2 class="mb-4">Listagem de Contas Poupanças</h2>
    <a href="{{ route('listaClientesContaCorrente') }}" class="btn btn-primary mb-3">Voltar para Painel de Contas</a>
    @if(count($contasPoupanca) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID da Poupança</th>
                <th scope="col">ID da Conta</th>
                <th scope="col">Nome do Cliente</th>
                <th scope="col">Taxa de Juros</th>
                <th scope="col">Data de Vencimento</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contasPoupanca as $contaPoupanca)
            <tr>
                <td>{{ $contaPoupanca->id }}</td>
                <td>{{ $contaPoupanca->ID_Conta }}</td>
                <td>{{ $contaPoupanca->NomeCliente }}</td>
                <td>{{ number_format($contaPoupanca->TaxaJuros, 2, ',', '.') }}</td>
                <td>{{ date('d/m/Y', strtotime($contaPoupanca->DataVencimento)) }}</td>

                <td>
                    <a href="{{ route('deletarContaPoupanca', ['id' => $contaPoupanca->id]) }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar a conta poupança?')">Deletar Conta Poupança</a>
                    <a href="{{ route('editarContaPoupanca', ['id' => $contaPoupanca->id]) }}" class="btn btn-warning">Editar Dados</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-3">Nenhuma conta poupança encontrada.</p>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
