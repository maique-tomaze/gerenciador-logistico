<?php
include "conexao.php";

$resultado = $conexao->query(
    "SELECT id, nome, rua, numero, bairro, cidade, estado, cep
     FROM enderecos
     ORDER BY id DESC"
);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endereços cadastrados</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; color: #222; }
        table { border-collapse: collapse; width: 100%; margin-top: 1rem; }
        th, td { border: 1px solid #ccc; padding: .6rem; text-align: left; }
        th { background: #f2f2f2; }
        a { display: inline-block; margin-top: 1rem; }
    </style>
</head>
<body>
    <h1>Endereços cadastrados</h1>
    <p><a href="index.php">Voltar ao menu principal</a></p>

    <?php if (!$resultado): ?>
        <p>Não foi possível carregar os endereços: <?= htmlspecialchars($conexao->error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php elseif ($resultado->num_rows === 0): ?>
        <p>Nenhum endereço cadastrado ainda.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nome</th><th>Rua</th><th>Número</th><th>Bairro</th>
                    <th>Cidade</th><th>Estado</th><th>CEP</th><th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($endereco = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($endereco['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($endereco['rua'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars((string) $endereco['numero'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($endereco['bairro'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($endereco['cidade'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($endereco['estado'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($endereco['cep'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><a href="editar_endereco.php?id=<?= (int) $endereco['id'] ?>">Editar</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="enderecos.php.php">Cadastrar outro endereço</a>
</body>
</html>
<?php
$conexao->close();
?>
