<!-- resources/views/clientes.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>

    <!-- Adicionando Bootstrap via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Cadastrar Cliente</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('salvarCliente') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="Nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="Nome" id="Nome" placeholder="Digite o nome completo" required maxlength="255">
        </div>

        <div class="mb-3">
            <label for="CPF" class="form-label">CPF:</label>
            <input type="text" class="form-control" name="CPF" id="CPF" placeholder="Digite o CPF (apenas números)" required maxlength="11">
        </div>

        <div class="mb-3">
            <label for="Endereco" class="form-label">Endereço:</label>
            <input type="text" class="form-control" name="Endereco" id="Endereco" placeholder="Digite o endereço" maxlength="255">
        </div>

        <div class="mb-3">
            <label for="Telefone" class="form-label">Telefone:</label>
            <input type="text" class="form-control" name="Telefone" id="Telefone" placeholder="Digite o telefone (números e caracteres)" maxlength="14">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    <!-- Adicionando botão de redirecionamento -->
    <a href="{{ route('listaClientesComContas') }}" class="btn btn-secondary mt-3">Ver Lista de Clientes</a>

    <!-- Adicionando Bootstrap e Popper.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
