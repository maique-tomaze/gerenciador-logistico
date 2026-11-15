<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Acesse esta página pelo formulário de cadastro.");
}

$nome = trim($_POST["nome"] ?? "");
$documento = trim($_POST["documento"] ?? "");
$telefone = trim($_POST["telefone"] ?? "");
$veiculo = trim($_POST["veiculo"] ?? "");
$placa = trim($_POST["placa"] ?? "");

if ($nome === "") {
    exit("Informe o nome do transportador.");
}

$sql = $conexao->prepare(
    "INSERT INTO transportadores (nome, documento, telefone, veiculo, placa)
     VALUES (?, ?, ?, ?, ?)"
);

if (!$sql) {
    exit("Erro ao preparar o cadastro. Confira se a tabela transportadores foi criada no banco.");
}

$sql->bind_param("sssss", $nome, $documento, $telefone, $veiculo, $placa);

if ($sql->execute()) {
    echo "Transportador cadastrado com sucesso!<br><a href='listar_transportadores.php'>Ver transportadores</a>";
} else {
    echo "Erro ao cadastrar transportador: " . htmlspecialchars($sql->error, ENT_QUOTES, "UTF-8");
}

$sql->close();
$conexao->close();
?>
