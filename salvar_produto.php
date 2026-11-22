<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Acesse esta página pelo formulário de cadastro.");
}

$nome = trim($_POST["nome"] ?? "");
$descricao = trim($_POST["descricao"] ?? "");
$quantidade = filter_var($_POST["quantidade"] ?? null, FILTER_VALIDATE_INT);
$preco = filter_var($_POST["preco"] ?? null, FILTER_VALIDATE_FLOAT);

if ($nome === "" || $quantidade === false || $quantidade < 0 || $preco === false || $preco < 0) {
    exit("Informe nome, quantidade e preço válidos.");
}

$sql = $conexao->prepare(
    "INSERT INTO produtos (nome, descricao, quantidade, preco)
     VALUES (?, ?, ?, ?)"
);

if (!$sql) {
    exit("Erro ao preparar o cadastro do produto.");
}

$sql->bind_param("ssid", $nome, $descricao, $quantidade, $preco);

if ($sql->execute()) {
    header("Location: listar_produtos.php");
    exit;
}

echo "Erro ao cadastrar produto: " . htmlspecialchars($sql->error, ENT_QUOTES, "UTF-8");
$sql->close();
$conexao->close();
?>