<?php
include "conexao.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(400);
    exit("Transportador inválido.");
}
$consulta = $conexao->prepare("SELECT nome, documento, telefone, veiculo, placa FROM transportadores WHERE id = ?");
$consulta->bind_param("i", $id);
$consulta->execute();
$transportador = $consulta->get_result()->fetch_assoc();
$consulta->close();
if (!$transportador) {
    http_response_code(404);
    exit("Transportador não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar transportador</title>
</head>
<body>
    <h1>Editar transportador</h1>
    <form action="atualizar_transportador.php" method="POST">
        <input type="hidden" name="id" value="<?= (int) $id ?>">
        <label>Nome do transportador ou empresa:<br><input type="text" name="nome" maxlength="120" value="<?= htmlspecialchars($transportador['nome'], ENT_QUOTES, 'UTF-8') ?>" required></label><br><br>
        <label>CPF ou CNPJ:<br><input type="text" name="documento" maxlength="20" value="<?= htmlspecialchars($transportador['documento'], ENT_QUOTES, 'UTF-8') ?>"></label><br><br>
        <label>Telefone:<br><input type="text" name="telefone" maxlength="20" value="<?= htmlspecialchars($transportador['telefone'], ENT_QUOTES, 'UTF-8') ?>"></label><br><br>
        <label>Veículo:<br><input type="text" name="veiculo" maxlength="80" value="<?= htmlspecialchars($transportador['veiculo'], ENT_QUOTES, 'UTF-8') ?>"></label><br><br>
        <label>Placa:<br><input type="text" name="placa" maxlength="10" value="<?= htmlspecialchars($transportador['placa'], ENT_QUOTES, 'UTF-8') ?>"></label><br><br>
        <button type="submit">Salvar alterações</button>
    </form>
    <p><a href="listar_transportadores.php">Voltar à lista</a></p>
</body>
</html>
<?php $conexao->close(); ?>
