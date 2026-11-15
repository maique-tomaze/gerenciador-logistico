cadastro_produtos.<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous">
</head>
<body class="container py-5">

    <h1>Cadastro de Produtos</h1>

    <form action="salvar_produto.php" method="POST">

        <div class="mb-3">
    <label for="nome" class="form-label">Nome do produto:</label>
    <input type="text" id="nome" name="nome" class="form-control" required>
</div>

<div class="mb-3">
    <label for="descricao" class="form-label">Descrição:</label>
    <textarea id="descricao" name="descricao" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label for="quantidade" class="form-label">Quantidade:</label>
    <input type="number" id="quantidade" name="quantidade" class="form-control" required>
</div>

<div class="mb-3">
    <label for="preco" class="form-label">Preço:</label>
    <input type="number" id="preco" name="preco" step="0.01" class="form-control" required>
</div>

<button type="submit" class="btn btn-primary">Cadastrar Produto</button>

    </form>

</body>
</html>