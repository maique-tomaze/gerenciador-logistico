<?php

include "conexao.php";

if (isset($_GET["id"])) {

    $id = (int) $_GET["id"];

    $sql = $conexao->prepare("DELETE FROM produtos WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        header("Location: listar_produtos.php");
        exit;
    } else {
        echo "Erro ao excluir produto.";
    }

    $sql->close();
}

$conexao->close();

?>