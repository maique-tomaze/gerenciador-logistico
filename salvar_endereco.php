<?php

include "conexao.php";

$nome = $_POST["nome"];
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$cep = $_POST["cep"];

$sql = $conexao->prepare(
    "INSERT INTO enderecos (nome, rua, numero, bairro, cidade, estado, cep)
     VALUES (?, ?, ?, ?, ?, ?, ?)"
);

$sql->bind_param(
    "sssssss",
    $nome,
    $rua,
    $numero,
    $bairro,
    $cidade,
    $estado,
    $cep
);

if ($sql->execute()) {
    echo "Endereço cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar endereço: " . $sql->error;
}

$sql->close();
$conexao->close();

?>