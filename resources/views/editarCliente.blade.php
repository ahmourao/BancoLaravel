<!-- resources/views/editarCliente.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>

    <!-- Adicionando Bootstrap via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <h2 class="mb-4">Editar Cliente</h2>
    <!-- Botão para redirecionar para a lista de clientes -->
    <a href="{{ route('listaClientesComContas') }}" class="btn btn-dark mb-3">Voltar para a lista de clientes</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('atualizarCliente', ['id' => $cliente->id]) }}" method="post">
        @csrf
        @method('put')

        <div class="mb-3 mt-5">
            <label for="Nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="Nome" id="Nome" value="{{ $cliente->Nome }}" required>
        </div>

        <div class="mb-3">
            <label for="CPF" class="form-label">CPF:</label>
            <input type="text" class="form-control" name="CPF" id="CPF" value="{{ $cliente->CPF }}" required>
        </div>

        <div class="mb-3">
            <label for="Endereco" class="form-label">Endereço:</label>
            <input type="text" class="form-control" name="Endereco" id="Endereco" value="{{ $cliente->Endereco }}">
        </div>

        <div class="mb-3">
            <label for="Telefone" class="form-label">Telefone:</label>
            <input type="text" class="form-control" name="Telefone" id="Telefone" value="{{ $cliente->Telefone }}">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>

    <!-- Adicionando Bootstrap e Popper.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>