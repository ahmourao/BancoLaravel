<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conta Poupança</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <h2 class="mb-4">Editar Conta Poupança</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <a href="{{ route('listarContasPoupancas') }}" class="btn btn-dark mt-3">Voltar para Listagem de Contas Poupança</a>

    <form method="POST" action="{{ route('atualizarContaPoupanca', ['id' => $contaPoupanca->id]) }}">
        @csrf
        @method('PATCH')

        <!-- Campos do formulário -->
        <div class="mb-3">
            <label for="taxaJuros" class="form-label">Taxa de Juros:</label>
            <input type="text" class="form-control" name="taxaJuros" value="{{ $contaPoupanca->TaxaJuros }}" required>
        </div>

        <div class="mb-3">
            <label for="dataVencimento" class="form-label">Data de Vencimento:</label>
            <input type="date" class="form-control" name="dataVencimento" value="{{ $contaPoupanca->DataVencimento }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Conta Poupança</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>