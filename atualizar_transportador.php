<?php
include "conexao.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Envie o formulário de edição.");
}
$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$nome = trim($_POST["nome"] ?? "");
$documento = trim($_POST["documento"] ?? "");
$telefone = trim($_POST["telefone"] ?? "");
$veiculo = trim($_POST["veiculo"] ?? "");
$placa = strtoupper(trim($_POST["placa"] ?? ""));
if (!$id || $nome === "") {
    exit("Informe o nome do transportador.");
}
$sql = $conexao->prepare(
    "UPDATE transportadores SET nome = ?, documento = ?, telefone = ?, veiculo = ?, placa = ? WHERE id = ?"
);
$sql->bind_param("sssssi", $nome, $documento, $telefone, $veiculo, $placa, $id);
if ($sql->execute()) {
    echo "Transportador atualizado com sucesso!<br><a href='listar_transportadores.php'>Voltar à lista de transportadores</a>";
} else {
    echo "Erro ao atualizar transportador: " . htmlspecialchars($sql->error, ENT_QUOTES, "UTF-8");
}
$sql->close();
$conexao->close();
?>
