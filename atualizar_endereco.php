<?php
include "conexao.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Envie o formulário de edição.");
}
$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$nome = trim($_POST["nome"] ?? "");
$rua = trim($_POST["rua"] ?? "");
$numero = trim($_POST["numero"] ?? "");
$bairro = trim($_POST["bairro"] ?? "");
$cidade = trim($_POST["cidade"] ?? "");
$estado = strtoupper(trim($_POST["estado"] ?? ""));
$cep = trim($_POST["cep"] ?? "");
if (!$id || $nome === "" || $rua === "") {
    exit("Preencha o nome e a rua do endereço.");
}
$sql = $conexao->prepare(
    "UPDATE enderecos SET nome = ?, rua = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, cep = ? WHERE id = ?"
);
$sql->bind_param("sssssssi", $nome, $rua, $numero, $bairro, $cidade, $estado, $cep, $id);
if ($sql->execute()) {
    echo "Endereço atualizado com sucesso!<br><a href='listar_enderecos.php'>Voltar à lista de endereços</a>";
} else {
    echo "Erro ao atualizar endereço: " . htmlspecialchars($sql->error, ENT_QUOTES, "UTF-8");
}
$sql->close();
$conexao->close();
?>
