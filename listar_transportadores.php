<?php
include "conexao.php";
$resultado = $conexao->query(
    "SELECT id, nome, documento, telefone, veiculo, placa
     FROM transportadores
     ORDER BY id DESC"
);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportadores cadastrados</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; color: #222; }
        table { border-collapse: collapse; width: 100%; margin-top: 1rem; }
        th, td { border: 1px solid #ccc; padding: .6rem; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Transportadores cadastrados</h1>
    <p><a href="index.php">Voltar ao menu principal</a></p>
    <?php if (!$resultado): ?>
        <p>Não foi possível carregar os transportadores. Confira se a tabela foi criada no banco de dados.</p>
    <?php elseif ($resultado->num_rows === 0): ?>
        <p>Nenhum transportador cadastrado ainda.</p>
    <?php else: ?>
        <table>
            <thead><tr><th>Nome</th><th>CPF/CNPJ</th><th>Telefone</th><th>Veículo</th><th>Placa</th><th>Ação</th></tr></thead>
            <tbody>
                <?php while ($transportador = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($transportador["nome"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($transportador["documento"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($transportador["telefone"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($transportador["veiculo"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($transportador["placa"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><a href="editar_transportador.php?id=<?= (int) $transportador['id'] ?>">Editar</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <p><a href="cadastro_transportadores.php">Cadastrar outro transportador</a></p>
</body>
</html>
<?php $conexao->close(); ?>
