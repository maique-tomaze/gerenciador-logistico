<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Endereços</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <p><a href="index.php">Voltar ao menu principal</a></p>
    <h1>Cadastro de Endereços</h1>

    <form action="salvar_endereco.php" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do endereço:</label>
            <input type="text" id="nome" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="rua" class="form-label">Rua:</label>
            <input type="text" id="rua" name="rua" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="numero" class="form-label">Número:</label>
            <input type="text" id="numero" name="numero" class="form-control">
        </div>
        <div class="mb-3">
            <label for="bairro" class="form-label">Bairro:</label>
            <input type="text" id="bairro" name="bairro" class="form-control">
        </div>
        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade:</label>
            <input type="text" id="cidade" name="cidade" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <input type="text" id="estado" name="estado" class="form-control" maxlength="2" minlength="2" required>
        </div>
        <div class="mb-3">
            <label for="cep" class="form-label">CEP:</label>
            <input type="text" id="cep" name="cep" class="form-control" inputmode="numeric">
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar Endereço</button>
    </form>

    <p class="mt-3"><a href="listar_enderecos.php">Ver endereços cadastrados</a></p>
</body>
</html>
