<?php
include "conexao.php";

$id = (int) $_GET["id"];

$sql = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");
$sql->bind_param("i", $id);
$sql->execute();

$resultado = $sql->get_result();
$produto = $resultado->fetch_assoc();

if (!$produto) {
    die("Produto não encontrado!");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>

<h1>Editar Produto</h1>

<form action="atualizar_produto.php" method="POST">

    <input type="hidden" name="id"
           value="<?php echo $produto['id']; ?>">

    Nome:<br>
    <input type="text" name="nome"
           value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
    <br><br>

    Descrição:<br>
    <textarea name="descricao"><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
    <br><br>

    Quantidade:<br>
    <input type="number" name="quantidade"
           value="<?php echo $produto['quantidade']; ?>" required>
    <br><br>

    Preço:<br>
    <input type="number" step="0.01" name="preco"
           value="<?php echo $produto['preco']; ?>" required>
    <br><br>

    <button type="submit">Salvar Alterações</button>

</form>

</body>
</html>