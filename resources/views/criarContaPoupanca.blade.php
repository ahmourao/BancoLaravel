<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta Poupança</title>

    <!-- Adicione os links do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="mb-4">Criar Conta Poupança</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('listaClientesContaCorrente') }}" class="btn btn-dark mb-3">Voltar para Painel de Contas</a>

        <form method="POST" action="{{ route('salvarContaPoupanca', ['id' => $idConta]) }}">
            @csrf

            <!-- Campos do formulário -->
            <div class="mb-3">
                <label for="taxaJuros" class="form-label">Taxa de Juros:</label>
                <input type="text" class="form-control" name="taxaJuros" required>
            </div>

            <div class="mb-3">
                <label for="dataVencimento" class="form-label">Data de Vencimento:</label>
                <input type="date" class="form-control" name="dataVencimento" required>
            </div>

            <button type="submit" class="btn btn-primary">Criar Conta Poupança</button>
        </form>
    </div>

    <!-- Adicione os scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Adicione outros elementos HTML ou scripts, se necessário -->

</body>
</html>
