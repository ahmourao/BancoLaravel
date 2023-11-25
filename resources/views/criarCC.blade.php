<!-- resources/views/criarContaCorrente.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta Corrente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <h2 class="mb-4">Criar Conta Corrente</h2>

    <form action="{{ route('salvarContaCorrente', ['idConta' => $conta->id]) }}" method="post">
        @csrf
        <!-- Exiba o nome do cliente -->
        <p>Cliente: {{ $cliente->Nome }}</p>
        
        <!-- Adicione aqui os campos para criar a conta corrente -->
        <div class="mb-3">
            <label for="LimiteCredito" class="form-label">Limite de Crédito:</label>
            <input type="number" class="form-control" name="LimiteCredito" id="LimiteCredito" placeholder="Exemplo: 1000.00" required>
        </div>

        <div class="mb-3">
            <label for="TarifaMensal" class="form-label">Tarifa Mensal:</label>
            <input type="number" class="form-control" name="TarifaMensal" id="TarifaMensal" placeholder="Exemplo: 20.00" required>
        </div>


        <button type="submit" class="btn btn-primary">Salvar Conta Corrente</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>