<!-- resources/views/listaClientes.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>

    <!-- Adicionando Bootstrap via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <h2 class="mb-4">Painel de Controle de Cadastro</h2>

    <!-- Adicionando botão "Cadastrar Cliente" -->
    <a href="{{ route('formularioCliente') }}" class="btn btn-primary mb-3">Cadastrar Cliente</a>
    <a href="{{ route('formularioConta') }}" class="btn btn-primary mb-3">Cadastrar Conta</a>

    @if(count($clientes) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th> <!-- Adicionando a coluna "ID" -->
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Telefone</th>
                <th scope="col">Tipo de Conta</th>
                <th scope="col">Saldo</th>
                <th scope="col">Ações</th> <!-- Adicionando a coluna "Ações" -->
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td> <!-- Exibindo o ID do cliente -->
                <td>{{ $cliente->Nome }}</td>
                <td>{{ $cliente->CPF }}</td>
                <td>{{ $cliente->Telefone }}</td>
                <td>
                    @if ($cliente->conta)
                    {{ $cliente->conta->TipoConta }}
                    @else
                    Sem conta associada
                    @endif
                </td>
                <td>
                    @if ($cliente->conta)
                    {{ $cliente->conta->Saldo }}
                    @else
                    Sem conta associada
                    @endif
                </td>
                <td>
                    <a href="{{ route('editarCliente', ['id' => $cliente->id]) }}" class="btn btn-warning">Editar Cliente</a>

                    @if ($cliente->conta)
                    <a href="{{ route('editarConta', ['id' => $cliente->conta->id]) }}" class="btn btn-info">Editar Conta</a>
                    @endif

                    <a href="{{ route('deletarCliente', ['id' => $cliente->id]) }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este cliente?')">Deletar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-3">Nenhum cliente cadastrado ainda.</p>
    @endif

    <!-- Adicionando Bootstrap e Popper.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>