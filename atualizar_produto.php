<?php

include "conexao.php";

$id = (int) $_POST["id"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$quantidade = (int) $_POST["quantidade"];
$preco = (float) $_POST["preco"];

$sql = $conexao->prepare(
    "UPDATE produtos SET nome = ?, descricao = ?, quantidade = ?, preco = ? WHERE id = ?"
);

$sql->bind_param("ssidi", $nome, $descricao, $quantidade, $preco, $id);

if ($sql->execute()) {
    header("Location: listar_produtos.php");
    exit;
} else {
    echo "Erro ao atualizar produto.";
}

$sql->close();
$conexao->close();

?>