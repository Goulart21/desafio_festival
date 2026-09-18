<?php

require_once __DIR__ . '/../config/config.php';

$totalParticipantes = $pdo->query(
    "SELECT COUNT(*) FROM participantes"
)->fetchColumn();

$totalAtividades = $pdo->query(
    "SELECT COUNT(*) FROM atividades"
)->fetchColumn();

$totalInscricoes = $pdo->query(
    "SELECT COUNT(*) FROM inscricoes WHERE status = 'ATIVA'"
)->fetchColumn();

$ocupacaoAtividade = $pdo->query(
    "SELECT
        a.nome_atividade,
        a.capacidade,
        COUNT(i.id_atividade) AS inscritos
        FROM atividades a
        LEFT JOIN inscricoes i
            ON a.id_atividade = i.id_atividade
            AND i.status = 'ATIVA'
            GROUP BY
            a.id_atividade,
            a.nome_atividade,
            a.capacidade
            ORDER BY a.nome_atividade"
)->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="csss/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h1>Festival Experiência Viva</h1>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavegacao"
                    aria-controls="menuNavegacao" aria-expanded="false" aria-label="Abrir menu"><span class="navbar-toggler-icon"></span></button>

                <div class="collpse navbar-collapse" id="menuNavegacao">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="participantes.php">
                                Participantes
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="atividades.php">
                                Atividades
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="inscricoes.php" class="nav-link">
                                Inscrições
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>

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

                            <p class="display-6 fw-bold">
                                <?= $totalParticipantes ?>
                            </p>

                            <p class="card-text">
                                Participantes cadastrados
                            </p>

                            <a href="participantes.php"><button class="btn btn-dark">
                                    Participantes
                                </button></a>
                        </div>
                    </div>
                </div>

                <div class="col">

                    <div class="card h-100">

                        <div class="card-body">
                            <h2 class="card-title h5">
                                Atividades
                            </h2>

                            <p class="display-6 fw-bold">
                                <?= $totalAtividades ?>
                            </p>

                            <p class="card-text">
                                Atividades cadstradas
                            </p>

                            <a href="atividades.php"><button class="btn btn-dark">Gerenciar Atividades</button></a>
                        </div>
                    </div>
                </div>

                <div class="col">

                    <div class=" card h-100">

                        <div class="card-body">

                            <h2 class="card-title h5">
                                Inscrições
                            </h2>

                            <p class="display-6 fw-bold">
                                <?= $totalInscricoes ?>
                            </p>

                            <p class="card-text">
                                Inscrições cadastradas
                            </p>

                            <a href="inscricoes.php"><button class="btn btn-dark">Gerenciar inscricões</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container pb-5">

            <div class="card">
                <div class="card-body">

                    <h2 class="h4 mb-4">Ocupação das atividades</h2>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Atividades</th>
                                    <th>Inscritos</th>
                                    <th>Capacidade</th>
                                    <th>Ocupação</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($ocupacaoAtividade as $atividade): ?>

                                    <?php
                                    $percentual = $atividade['capacidade'] > 0
                                        ? ($atividade['inscritos'] / $atividade['capacidade']) * 100
                                        : 0;
                                    ?>

                                    <tr>
                                        <td>
                                            <?= htmlspecialchars($atividade['nome_atividade']) ?>
                                        </td>

                                        <td>
                                            <?= $atividade['inscritos'] ?>
                                        </td>

                                        <td>
                                            <?= $atividade['capacidade'] ?>
                                        </td>

                                        <td>
                                            <?= number_format($percentual, 0) ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
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