<?php
include "conexao.php";

$transportadores = $conexao->query("SELECT id, nome FROM transportadores ORDER BY nome");
$enderecos = $conexao->query("SELECT id, nome, cidade, estado FROM enderecos ORDER BY nome");
$produtos = $conexao->query("SELECT id, nome, quantidade FROM produtos ORDER BY nome");

$semTransportadores = !$transportadores || $transportadores->num_rows === 0;
$semEnderecos = !$enderecos || $enderecos->num_rows < 2;
$semProdutos = !$produtos || $produtos->num_rows === 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Fretes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 850px;
            margin: 2rem auto;
            padding: 0 1rem;
            color: #222;
        }

        label { font-weight: bold; }
        select, input, button { padding: .55rem; margin-top: .3rem; }
        .campo { margin-bottom: 1rem; }
        .produto-linha {
            display: flex;
            gap: .6rem;
            align-items: end;
            margin: .7rem 0;
            flex-wrap: wrap;
        }
        .produto-linha select { min-width: 280px; }
        .aviso { padding: .8rem; background: #fff3cd; }
    </style>
</head>
<body>
    <p><a href="index.php">Voltar ao menu principal</a></p>
    <h1>Cadastrar frete</h1>

    <?php if ($semTransportadores || $semEnderecos || $semProdutos): ?>
        <p class="aviso">Para cadastrar um frete, são necessários pelo menos um transportador, dois endereços e um produto.</p>
        <ul>
            <?php if ($semTransportadores): ?><li><a href="cadastro_transportadores.php">Cadastrar transportador</a></li><?php endif; ?>
            <?php if ($semEnderecos): ?><li><a href="enderecos.php.php">Cadastrar endereços</a></li><?php endif; ?>
            <?php if ($semProdutos): ?><li><a href="cadastro_produtos.php">Cadastrar produto</a></li><?php endif; ?>
        </ul>
    <?php else: ?><form action="salvar_frete.php" method="POST">
    <div class="campo">
        <label for="transportador_id">Transportador:</label><br>
        <select id="transportador_id" name="transportador_id" class="form-select" required>
            <option value="">Selecione</option>
            <?php while ($item = $transportadores->fetch_assoc()): ?>
                <option value="<?= (int) $item['id'] ?>">
                    <?= htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="campo">
        <label for="origem_id">Endereço de origem:</label><br>
        <select id="origem_id" name="origem_id" class="form-select" required>
            <option value="">Selecione</option>
            <?php while ($item = $enderecos->fetch_assoc()): ?>
                <option value="<?= (int) $item['id'] ?>">
                    <?= htmlspecialchars($item['nome'] . ' - ' . $item['cidade'] . '/' . $item['estado'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="campo">
        <label for="destino_id">Endereço de destino:</label><br>
        <select id="destino_id" name="destino_id" class="form-select" required>
            <option value="">Selecione</option>
            <?php
            $enderecos->data_seek(0);
            while ($item = $enderecos->fetch_assoc()):
            ?>
                <option value="<?= (int) $item['id'] ?>">
                    <?= htmlspecialchars($item['nome'] . ' - ' . $item['cidade'] . '/' . $item['estado'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endwhile; ?>
        </select>
             </div>
               
         

            <div class="campo">
    <label for="data_frete">Data do frete:</label><br>
    <input type="date" id="data_frete" name="data_frete" class="form-control" required>
</div>

<fieldset>
    <legend>Produtos transportados</legend>
                <div id="produtos-container">
                    <div class="produto-linha">
                        <select name="produto_id[]" class="form-select" required aria-label="Produto">
                            <option value="">Selecione um produto</option>
                            <?php while ($item = $produtos->fetch_assoc()): ?>
                                <option value="<?= (int) $item['id'] ?>"><?= htmlspecialchars($item['nome'] . ' (estoque: ' . $item['quantidade'] . ')', ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endwhile; ?>
                        </select>
                       <label>Quantidade <input type="number" name="quantidade[]" class="form-control w-auto" min="1" value="1" required></label>
                    </div>
                </div>
                <button type="button" id="adicionar-produto" class="btn btn-outline-primary">Adicionar outro produto</button>
            </fieldset>

           <p><button type="submit" class="btn btn-primary">Cadastrar frete</button></p>
        </form>
    <?php endif; ?>

    <p><a href="listar_fretes.php">Ver fretes cadastrados</a></p>

    <script>
        document.getElementById('adicionar-produto')?.addEventListener('click', function () {
            const container = document.getElementById('produtos-container');
            const primeiraLinha = container.querySelector('.produto-linha');
            const novaLinha = primeiraLinha.cloneNode(true);
            novaLinha.querySelector('select').value = '';
            novaLinha.querySelector('input').value = '1';
            const remover = document.createElement('button');
            remover.type = 'button';
            remover.textContent = 'Remover';
            remover.addEventListener('click', () => novaLinha.remove());
            novaLinha.appendChild(remover);
            container.appendChild(novaLinha);
        });
    </script>
</body>
</html>
<?php $conexao->close(); ?>