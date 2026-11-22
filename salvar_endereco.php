<?php

include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Acesse esta página pelo formulário de cadastro.");
}

$nome = trim($_POST["nome"] ?? "");
$rua = trim($_POST["rua"] ?? "");
$numero = trim($_POST["numero"] ?? "");
$bairro = trim($_POST["bairro"] ?? "");
$cidade = trim($_POST["cidade"] ?? "");
$estado = strtoupper(trim($_POST["estado"] ?? ""));
$cep = trim($_POST["cep"] ?? "");

if ($nome === "" || $rua === "" || $cidade === "" || !preg_match('/^[A-Z]{2}$/', $estado)) {
    exit("Informe nome, rua, cidade e estado válidos.");
}

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
    header("Location: listar_enderecos.php");
    exit;
} else {
    echo "Erro ao cadastrar endereço: " . $sql->error;
}

$sql->close();
$conexao->close();

?>