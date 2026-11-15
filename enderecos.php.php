<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Endereços</title>
</head><p><a href="index.php">Voltar ao menu principal</a></p>
<body>

    <h1>Cadastro de Endereços</h1>

    <form action="salvar_endereco.php" method="POST">

        Nome do endereço:<br>
        <input type="text" name="nome" required><br><br>

        Rua:<br>
        <input type="text" name="rua" required><br><br>

        Número:<br>
        <input type="text" name="numero"><br><br>

        Bairro:<br>
        <input type="text" name="bairro"><br><br>

        Cidade:<br>
        <input type="text" name="cidade"><br><br>

        Estado:<br>
        <input type="text" name="estado" maxlength="2"><br><br>

        CEP:<br>
        <input type="text" name="cep"><br><br>

        <button type="submit">Cadastrar Endereço</button>

    </form>

    <p><a href="listar_enderecos.php">Ver endereços cadastrados</a></p>

</body>
</html>
