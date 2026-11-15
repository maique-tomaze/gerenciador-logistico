<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciador Logístico</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Gerenciador Logístico</a>

            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="listar_produtos.php">Produtos</a>
                <a class="nav-link" href="listar_enderecos.php">Endereços</a>
                <a class="nav-link" href="listar_transportadores.php">Transportadores</a>
                <a class="nav-link" href="listar_fretes.php">Fretes</a><nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
        
    <div>
    </div>
</nav>
                <a class="nav-link" href="relatorio_fretes.php">Relatórios</a>

            </div>
        </div>
    </nav>

    <main class="container py-5">
        <div class="p-4 mb-4 bg-white rounded-3 shadow-sm">
            <h1>Gerenciador Logístico</h1>
            <p class="lead">
                Cadastre produtos, endereços e transportadores.
                Organize fretes e consulte relatórios por data.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="h5">Produtos</h2>
                        <p>Cadastre e consulte os produtos.</p>
                        <a class="btn btn-primary" href="cadastro_produtos.php">Abrir produtos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="h5">Endereços</h2>
                        <p>Organize os locais de origem e destino.</p>
                        <a class="btn btn-primary" href="enderecos.php.php">Cadastrar endereço</a>
                        <a class="btn btn-outline-primary" href="listar_enderecos.php">Ver lista</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="h5">Transportadores</h2>
                        <p>Consulte e cadastre transportadores.</p>
                        <a class="btn btn-primary" href="cadastro_transportadores.php">Abrir transportadores</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="h5">Fretes</h2>
                        <p>Relacione transportador, endereços e produtos.</p>
                        <a class="btn btn-primary" href="cadastro_fretes.php">Cadastrar frete</a>
                        <a class="btn btn-outline-primary" href="listar_fretes.php">Ver lista</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="h5">Relatório diário</h2>
                        <p>Consulte os fretes de uma data e baixe o arquivo.</p>
                        <a class="btn btn-primary" href="relatorio_fretes.php">Abrir relatório</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>