<?php
include "conexao.php";
$sql = "SELECT f.id, f.data_frete, t.nome AS transportador,
               o.nome AS origem, o.cidade AS cidade_origem, o.estado AS estado_origem,
               d.nome AS destino, d.cidade AS cidade_destino, d.estado AS estado_destino
        FROM fretes f
        INNER JOIN transportadores t ON t.id = f.transportador_id
        INNER JOIN enderecos o ON o.id = f.origem_id
        INNER JOIN enderecos d ON d.id = f.destino_id
        ORDER BY f.data_frete DESC, f.id DESC";
$fretes = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fretes cadastrados</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; color: #222; }
        .frete { border: 1px solid #ccc; padding: 1rem; margin: 1rem 0; }
        table { border-collapse: collapse; margin-top: .6rem; }
        th, td { border: 1px solid #ccc; padding: .4rem .7rem; text-align: left; }
    </style>
</head>
<body>
    <h1>Fretes cadastrados</h1>
    <p><a href="index.php">Voltar ao menu principal</a></p>
    <?php if (!$fretes): ?>
        <p>Não foi possível carregar os fretes. Confira se as tabelas do frete foram criadas.</p>
    <?php elseif ($fretes->num_rows === 0): ?>
        <p>Nenhum frete cadastrado ainda.</p>
    <?php else: ?>
        <?php while ($frete = $fretes->fetch_assoc()): ?>
            <section class="frete">
                <h2>Frete #<?= (int) $frete['id'] ?></h2>
                <p><strong>Data:</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($frete['data_frete'])), ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Transportador:</strong> <?= htmlspecialchars($frete['transportador'], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Origem:</strong> <?= htmlspecialchars($frete['origem'] . ' - ' . $frete['cidade_origem'] . '/' . $frete['estado_origem'], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Destino:</strong> <?= htmlspecialchars($frete['destino'] . ' - ' . $frete['cidade_destino'] . '/' . $frete['estado_destino'], ENT_QUOTES, 'UTF-8') ?></p>
                <strong>Produtos:</strong>
                <table>
                    <thead><tr><th>Produto</th><th>Quantidade</th></tr></thead>
                    <tbody>
                    <?php
                    $itens = $conexao->prepare(
                        "SELECT p.nome, fp.quantidade FROM frete_produtos fp
                         INNER JOIN produtos p ON p.id = fp.produto_id
                         WHERE fp.frete_id = ? ORDER BY p.nome"
                    );
                    $idFrete = (int) $frete['id'];
                    $itens->bind_param("i", $idFrete);
                    $itens->execute();
                    $resultadoItens = $itens->get_result();
                    while ($item = $resultadoItens->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= (int) $item['quantidade'] ?></td>
                        </tr>
                    <?php endwhile; $itens->close(); ?>
                    </tbody>
                </table>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
    <p><a href="cadastro_fretes.php">Cadastrar novo frete</a></p>
    <p><a href="relatorio_fretes.php">Relatório de fretes por dia</a></p>
</body>
</html>
<?php $conexao->close(); ?>
