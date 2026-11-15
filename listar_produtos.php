listar_produtos.php<?php
include "conexao.php";

$sql = "SELECT * FROM produtos";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos Cadastrados</title>
</head>
<body>

    <h1>Produtos Cadastrados</h1>
    <p><a href="index.php">Voltar ao menu principal</a></p>

    <table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Quantidade</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>

    <?php while ($produto = $resultado->fetch_assoc()) { ?>

        <tr>
            <td><?php echo $produto["id"]; ?></td>

            <td><?php echo htmlspecialchars($produto["nome"]); ?></td>

            <td><?php echo htmlspecialchars($produto["descricao"]); ?></td>

            <td><?php echo $produto["quantidade"]; ?></td>

            <td><?php echo $produto["preco"]; ?></td>

        <td>
    <a href="editar_produto.php?id=<?php echo $produto['id']; ?>">
        Editar
    </a>

    |

    <a href="excluir_produto.php?id=<?php echo $produto['id']; ?>"
       onclick="return confirm('Deseja realmente excluir este produto?')">
        Excluir
    </a>
</td>
        </tr>

    <?php } ?>

</table>

    <br>
    <a href="cadastro_produtos.php">Cadastrar novo produto</a>

</body>
</html>
