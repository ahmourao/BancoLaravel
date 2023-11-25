<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Conta Corrente</title>
    
    <!-- Adicione os links do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Se você precisar de mais personalizações ou outros cabeçalhos, adicione aqui -->
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="mb-4">Alterar Conta Corrente</h1>

        <a href="{{ route('listarContasCorrentes') }}" class="btn btn-dark mt-3">Voltar para Listagem de CC</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('atualizarContaCorrente', ['id' => $contaCorrente->id]) }}">
            @csrf
            @method('PATCH')

            <!-- Campos do formulário -->
            <div class="mb-3">
                <label for="limiteCredito" class="form-label">Limite de Crédito:</label>
                <input type="text" class="form-control" name="limiteCredito" value="{{ $contaCorrente->LimiteCredito }}" required>
            </div>

            <div class="mb-3">
                <label for="tarifaMensal" class="form-label">Tarifa Mensal:</label>
                <input type="text" class="form-control" name="tarifaMensal" value="{{ $contaCorrente->TarifaMensal }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Conta Corrente</button>
        </form>
    </div>

    <!-- Adicione outros elementos HTML ou scripts, se necessário -->

</body>
</html>
