<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    <title>Pagina Inicial</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h1>Experiência Viva</h1>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavegacao"
                    aria-controls="menuNavegacao" aria-expanded="false" aria-label="Abrir menu"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="menuNavegacao">

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="participante.php">
                                Participantes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="atividades.php" class="nav-link">
                                Atividades
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="inscricao.php" class="nav-link">
                                Inscrições
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <main class="container">

        <section class="container text-center py-5">
            <h1 class="display-5 fw-bold">
                Painel Administrativo
            </h1>

            <p class="lead text-body-secondary">
                Gerenciamento do Festival Experiência Viva
            </p>
        </section>

        <section class="container pb-5">

            <div class="row row-cols-1 row-cols-md-3 g-4">

                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">

                            <h2 class="card-title h5">
                                Participantes
                            </h2>

                            <p class="card-text">
                                Cadastro, consulte, atualize e gerencie
                                os participantes do festival
                            </p>

                            <a href="participante.php"><button class="btn btn-dark">Gerenciar Participante</button></a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">

                        <div class="card-body">
                            <h2 class="card-title h5">
                                Atividades
                            </h2>
                            <p class="card-text">
                                Organize e crie as atividades, horários,
                                locais e capacidade
                            </p>

                            <a href="atividades.php"><button class="btn btn-dark">Gerenciar Atividades</button></a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title h5">
                                Inscrições
                            </h2>
                            <p class="card-text">
                                Realize as incrições dos participantes e as acompanhe
                            </p>
                            <a href="inscricao.php"><button class="btn btn-dark">
                                    Gerenciar Inscrições
                                </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        Festival Experiência Viva
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>