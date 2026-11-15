<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Acesse esta página pelo formulário de frete.");
}

$transportadorId = filter_input(INPUT_POST, "transportador_id", FILTER_VALIDATE_INT);
$origemId = filter_input(INPUT_POST, "origem_id", FILTER_VALIDATE_INT);
$destinoId = filter_input(INPUT_POST, "destino_id", FILTER_VALIDATE_INT);
$dataFrete = $_POST["data_frete"] ?? "";
$produtoIds = $_POST["produto_id"] ?? [];
$quantidades = $_POST["quantidade"] ?? [];

if (!$transportadorId || !$origemId || !$destinoId || $origemId === $destinoId || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataFrete)) {
    exit("Confira o transportador, os endereços diferentes e a data do frete.");
}

if (!is_array($produtoIds) || !is_array($quantidades) || count($produtoIds) === 0 || count($produtoIds) !== count($quantidades)) {
    exit("Adicione pelo menos um produto e informe a quantidade.");
}

$itens = [];
foreach ($produtoIds as $indice => $produtoIdRaw) {
    $produtoId = filter_var($produtoIdRaw, FILTER_VALIDATE_INT);
    $quantidade = filter_var($quantidades[$indice] ?? null, FILTER_VALIDATE_INT);
    if (!$produtoId || !$quantidade || $quantidade < 1) {
        exit("Confira os produtos e as quantidades informadas.");
    }
    if (isset($itens[$produtoId])) {
        $itens[$produtoId] += $quantidade;
    } else {
        $itens[$produtoId] = $quantidade;
    }
}

$conexao->begin_transaction();
try {
    $novoFrete = $conexao->prepare(
        "INSERT INTO fretes (transportador_id, origem_id, destino_id, data_frete)
         VALUES (?, ?, ?, ?)"
    );
    if (!$novoFrete) {
        throw new Exception("Não foi possível preparar o cadastro do frete. Confira se as tabelas foram criadas.");
    }
    $novoFrete->bind_param("iiis", $transportadorId, $origemId, $destinoId, $dataFrete);
    if (!$novoFrete->execute()) {
        throw new Exception("Confira se o transportador e os endereços selecionados existem.");
    }
    $freteId = $conexao->insert_id;
    $novoFrete->close();

    $novoItem = $conexao->prepare(
        "INSERT INTO frete_produtos (frete_id, produto_id, quantidade) VALUES (?, ?, ?)"
    );
    if (!$novoItem) {
        throw new Exception("Não foi possível preparar os produtos do frete.");
    }
    foreach ($itens as $produtoId => $quantidade) {
        $novoItem->bind_param("iii", $freteId, $produtoId, $quantidade);
        if (!$novoItem->execute()) {
            throw new Exception("Confira se os produtos selecionados existem.");
        }
    }
    $novoItem->close();
    $conexao->commit();
    echo "Frete cadastrado com sucesso!<br><a href='listar_fretes.php'>Ver fretes cadastrados</a>";
} catch (Throwable $erro) {
    $conexao->rollback();
    echo htmlspecialchars($erro->getMessage(), ENT_QUOTES, "UTF-8");
}

$conexao->close();
?>
