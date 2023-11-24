<!-- resources/views/conta.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Conta</title>

    <!-- Adicionando Bootstrap via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Cadastro de Conta</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('salvarConta') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="ID_Cliente" class="form-label">ID do Cliente:</label>
            <input type="number" class="form-control" name="ID_Cliente" id="ID_Cliente" placeholder="Exemplo: 1" required>
        </div>

        <div class="mb-3">
            <label for="TipoConta" class="form-label">Tipo de Conta:</label>
            <select class="form-select" name="TipoConta" id="TipoConta" required>
                <option value="Conta Corrente">Conta Corrente</option>
                <option value="Conta Poupança">Conta Poupança</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Saldo" class="form-label">Saldo:</label>
            <input type="number" class="form-control" name="Saldo" id="Saldo" placeholder="Exemplo: 1000.00" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>

        <!-- Botão para redirecionar para o formulário de cadastro de cliente -->
        <a href="{{ route('formularioCliente') }}" class="btn btn-secondary">Cadastrar Cliente</a>

        <!-- Botão para redirecionar para a lista de clientes -->
        
        <a href="{{ route('listaClientesComContas') }}" class="btn btn-info">Ver Lista de Clientes</a>
    </form>

    <!-- Adicionando Bootstrap e Popper.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
