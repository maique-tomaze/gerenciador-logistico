<?php
include "conexao.php";

$data = $_GET["data"] ?? "";
$dataValida = preg_match('/^\d{4}-\d{2}-\d{2}$/', $data) === 1;
$linhas = [];
$erro = "";

if ($dataValida) {
    $consulta = $conexao->prepare(
        "SELECT f.id, f.data_frete, t.nome AS transportador,
                CONCAT_WS(', ', o.nome, NULLIF(o.cidade, ''), NULLIF(o.estado, '')) AS origem,
                CONCAT_WS(', ', d.nome, NULLIF(d.cidade, ''), NULLIF(d.estado, '')) AS destino,
                p.nome AS produto, fp.quantidade
         FROM fretes f
         INNER JOIN transportadores t ON t.id = f.transportador_id
         INNER JOIN enderecos o ON o.id = f.origem_id
         INNER JOIN enderecos d ON d.id = f.destino_id
         INNER JOIN frete_produtos fp ON fp.frete_id = f.id
         INNER JOIN produtos p ON p.id = fp.produto_id
         WHERE f.data_frete = ?
         ORDER BY f.id, p.nome"
    );

    if (!$consulta) {
        $erro = "Não foi possível preparar o relatório.";
    } else {
        $consulta->bind_param("s", $data);
        $consulta->execute();
        $resultado = $consulta->get_result();
        while ($linha = $resultado->fetch_assoc()) {
            $linhas[] = $linha;
        }
        $consulta->close();
    }

    if (isset($_GET["exportar"]) && $_GET["exportar"] === "1" && $erro === "") {
        if (ob_get_length()) {
            ob_clean();
        }
        header("Content-Type: text/csv; charset=UTF-8");
        header("Content-Disposition: attachment; filename=relatorio-fretes-" . $data . ".csv");
        echo "\xEF\xBB\xBF";
        $saida = fopen("php://output", "w");
        fputcsv($saida, ["Frete", "Data", "Transportador", "Origem", "Destino", "Produto", "Quantidade"], ";");
        foreach ($linhas as $linha) {
            fputcsv($saida, [
                $linha["id"],
                date("d/m/Y", strtotime($linha["data_frete"])),
                $linha["transportador"],
                $linha["origem"],
                $linha["destino"],
                $linha["produto"],
                $linha["quantidade"]
            ], ";");
        }
        fclose($saida);
        $conexao->close();
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Fretes por Dia</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; color: #222; }
        table { border-collapse: collapse; width: 100%; margin-top: 1rem; }
        th, td { border: 1px solid #ccc; padding: .6rem; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório de fretes por dia</h1>
    <p><a href="index.php">Voltar ao menu principal</a></p>
    <form method="GET" action="relatorio_fretes.php">
        <label for="data">Escolha o dia:</label>
        <input type="date" id="data" name="data" value="<?= htmlspecialchars($data, ENT_QUOTES, 'UTF-8') ?>" required>
        <button type="submit">Consultar</button>
    </form>

    <?php if ($erro !== ""): ?>
        <p><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php elseif ($dataValida): ?>
        <?php if (count($linhas) === 0): ?>
            <p>Nenhum frete encontrado para esse dia.</p>
        <?php else: ?>
            <p>Foram encontrados <?= count($linhas) ?> item(ns) de produto nos fretes deste dia.</p>
            <table>
                <thead><tr><th>Frete</th><th>Data</th><th>Transportador</th><th>Origem</th><th>Destino</th><th>Produto</th><th>Quantidade</th></tr></thead>
                <tbody>
                    <?php foreach ($linhas as $linha): ?>
                        <tr>
                            <td><?= (int) $linha["id"] ?></td>
                            <td><?= htmlspecialchars(date("d/m/Y", strtotime($linha["data_frete"])), ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($linha["transportador"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($linha["origem"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($linha["destino"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($linha["produto"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= (int) $linha["quantidade"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><a href="relatorio_fretes.php?data=<?= rawurlencode($data) ?>&amp;exportar=1">Baixar relatório CSV</a></p>
        <?php endif; ?>
    <?php endif; ?>

    <p><a href="listar_fretes.php">Voltar à lista de fretes</a></p>
</body>
</html>
<?php $conexao->close(); ?>
