<?php
include "conexao.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(400);
    exit("Endereço inválido.");
}
$consulta = $conexao->prepare("SELECT nome, rua, numero, bairro, cidade, estado, cep FROM enderecos WHERE id = ?");
$consulta->bind_param("i", $id);
$consulta->execute();
$endereco = $consulta->get_result()->fetch_assoc();
$consulta->close();
if (!$endereco) {
    http_response_code(404);
    exit("Endereço não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar endereço</title>
</head>
<body>
    <h1>Editar endereço</h1>
    <form action="atualizar_endereco.php" method="POST">
        <input type="hidden" name="id" value="<?= (int) $id ?>">
        <label>Nome do endereço:<br><input type="text" name="nome" value="<?= htmlspecialchars($endereco['nome'], ENT_QUOTES, 'UTF-8') ?>" required></label><br><br>
        <label>Rua:<br><input type="text" name="rua" value="<?= htmlspecialchars($endereco['rua'], ENT_QUOTES, 'UTF-8') ?>" required></label><br><br>
        <label>Número:<br><input type="text" name="numero" value="<?= htmlspecialchars((string) $endereco['numero'], ENT_QUOTES, 'UTF-8') ?>"></label><br><br>
        <label>Bairro:<br><input type="text" name="bairro" value="<?= htmlspecialchars($endereco['bairro'], ENT_QUOTES, 'UTF-8') ?>"></label><br><br>
        <label>Cidade:<br><input type="text" name="cidade" value="<?= htmlspecialchars($endereco['cidade'], ENT_QUOTES, 'UTF-8') ?>"></label><br><br>
        <label>Estado:<br><input type="text" name="estado" maxlength="2" value="<?= htmlspecialchars($endereco['estado'], ENT_QUOTES, 'UTF-8') ?>"></label><br><br>
        <label>CEP:<br><input type="text" name="cep" value="<?= htmlspecialchars($endereco['cep'], ENT_QUOTES, 'UTF-8') ?>"></label><br><br>
        <button type="submit">Salvar alterações</button>
    </form>
    <p><a href="listar_enderecos.php">Voltar à lista</a></p>
</body>
</html>
<?php $conexao->close(); ?>
