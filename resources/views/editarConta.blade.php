<!-- resources/views/editarConta.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conta</title>

    <!-- Adicionando Bootstrap via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <h2 class="mb-4">Editar Conta</h2>

    <!-- Botão para redirecionar para a lista de clientes -->
    <a href="{{ route('listaClientesComContas') }}" class="btn btn-dark mb-3">Voltar para a lista de clientes</a>

    <form action="{{ route('atualizarConta', ['id' => $cliente->id]) }}" method="post">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="nomeCliente" class="form-label">Nome do Cliente: {{ $cliente->Nome }}</label>
        </div>

        <div class="mb-3">
            <label for="cpfCliente" class="form-label">CPF: {{ $cliente->CPF }}</label>
        </div>

        <!-- Formulário para editar a conta -->
        <div class="mb-3">
            <label for="TipoConta" class="form-label">Tipo de Conta:</label>
            <select class="form-select" name="TipoConta" id="TipoConta" required>
                <option value="Conta Corrente" {{ $cliente->conta && $cliente->conta->TipoConta === 'Conta Corrente' ? 'selected' : '' }}>Conta Corrente</option>
                <option value="Conta Poupança" {{ $cliente->conta && $cliente->conta->TipoConta === 'Conta Poupança' ? 'selected' : '' }}>Conta Poupança</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Saldo" class="form-label">Saldo:</label>
            <input type="number" class="form-control" name="Saldo" id="Saldo" placeholder="Exemplo: 1000.00" value="{{ $cliente->conta ? $cliente->conta->Saldo : '' }}" required>
        </div>
        <!-- Fim do formulário para editar a conta -->

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>

    <!-- Adicionando Bootstrap e Popper.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>