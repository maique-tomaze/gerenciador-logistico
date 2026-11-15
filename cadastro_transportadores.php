<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Transportadores</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous">
</head>
<body class="container py-5">
    <h1>Cadastro de Transportadores</h1>

    <form action="salvar_transportador.php" method="POST">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do transportador ou empresa:</label>
        <input type="text" id="nome" name="nome" class="form-control" maxlength="120" required>
    </div>

    <div class="mb-3">
        <label for="documento" class="form-label">CPF ou CNPJ:</label>
        <input type="text" id="documento" name="documento" class="form-control" maxlength="20">
    </div>

    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone:</label>
        <input type="text" id="telefone" name="telefone" class="form-control" maxlength="20">
    </div>

    <div class="mb-3">
        <label for="veiculo" class="form-label">Veículo:</label>
        <input type="text" id="veiculo" name="veiculo" class="form-control" maxlength="80">
    </div>

    <div class="mb-3">
        <label for="placa" class="form-label">Placa:</label>
        <input type="text" id="placa" name="placa" class="form-control" maxlength="10">
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar transportador</button>
</form>

    <p><a href="listar_transportadores.php">Ver transportadores cadastrados</a></p>
</body>
</html>
