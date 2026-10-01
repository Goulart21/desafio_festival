<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/AtividadeModel.php';
require_once __DIR__ . '/../models/ParticipanteModel.php';
require_once __DIR__ . '/../models/InscricaoModel.php';

require_once __DIR__ . '/../services/AtividadeService.php';
require_once __DIR__ . '/../services/ParticipanteService.php';
require_once __DIR__ . '/../services/InscricaoService.php';

$participanteService = new ParticipanteService($pdo);
$atividadeService = new Atividadeservice($pdo);
$inscricaoService = new InscricaoService($pdo);

$participantes = $participanteService->listarParticipantes();
$atividades = $atividadeService->listarAtividade();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_participante = (int) $_POST['id_participante'];
    $id_atividade = (int) $_POST['id_atividade'];

    $inscricao = new InscricaoModel(
        $id_participante,
        $id_atividade
    );

    $resultado = $inscricaoService->cadastrarInscricao($inscricao);
    header('Location: inscricao.php?mensagem=' . $resultado);
}

$inscricoes = $inscricaoService->listarInscricoes();

if (isset($_GET['cancelar'])) {

    $id_inscricao = (int) $_GET['cancelar'];
    $inscricaoService->cancelarInscricao($id_inscricao);

    header('Location: inscricao.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Participantes</title>
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
                <div class="collpse navbar-collapse" id="menuNavegacao">

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

        <?php if (isset($_GET['mensagem'])): ?>

            <?php if ($_GET['mensagem'] === 'SUCESSO'): ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Inscrição Realizada

                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>

            <?php elseif ($_GET['mensagem'] === 'DUPLICADA'): ?>

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Inscrição duplicada

                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>

            <?php elseif ($_GET['mensagem'] === 'LOTADA'): ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Atividade lotada

                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>

            <?php elseif ($_GET['mensagem'] === 'ATIVIDADE_NAO_ENCONTRADA'): ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ATIVIDADE NÃO ENCONTRADA

                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>

            <?php elseif ($_GET['mensagem'] === 'ERRO'): ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ERRO
                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <section class="mb-4 mt-4">

            <h2 class="text-center">Cadastro de Inscrições</h2>

            <div class="row justify-content-center">

                <div class="col-md-8 col-lg-6">

                    <form action="" method="post">

                        <div class="mb-3">

                            <label for="id_participante" class="form-label">Participantes:</label>
                            <select name="id_participante" id="id_participante" class="form-select" required>
                                <option value="">
                                    Selecione um participante
                                </option>

                                <?php foreach ($participantes as $participante): ?>

                                    <option value="<?= $participante['id_participante'] ?>">
                                        <?= htmlspecialchars($participante['nome_participante']) ?>
                                    </option>

                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">

                            <label for="id_atividade" class="form-label">Atividade:</label>
                            <select name="id_atividade" id="id_atividade" class="form-select" required>
                                <option value="">
                                    Selecione um participante
                                </option>

                                <?php foreach ($atividades as $atividade): ?>

                                    <option value="<?= $atividade['id_atividade'] ?>">
                                        <?= htmlspecialchars($atividade['nome_atividade']) ?>
                                    </option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="text-center">

                            <button type="submit" class="btn btn-success">Inscrever Participante</button>
                        </div>


                    </form>
                </div>
            </div>
        </section>

        <section class="mb-4">

            <h2 class="text-center mt-5">Inscrições Cadastrados</h2>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Participante</th>
                            <th>Atividades</th>
                            <th>Data de Inscrição</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($inscricoes as $inscricao): ?>
                            <tr>
                                <td><?= htmlspecialchars($inscricao['nome_participante']) ?></td>
                                <td><?= htmlspecialchars($atividade['nome_atividade']) ?></td>
                                <td><?= $inscricao['data_inscricao'] ?></td>
                                <td><?= $inscricao['status'] ?></td>

                                <td>

                                    <?php if ($inscricao['status'] === 'ATIVA'): ?>
                                        <a href="inscricao.php?cancelar=<?= $inscricao['id_inscricao'] ?>"
                                            class="btn btn-danger" onclick="return confirm('Deseja cancelar essa inscrição ?')">Cancelar</a>
                                    <?php else: ?>
                                        <span class="text-muted">Cancelada</span>
                                </td>
                            <?php endif; ?>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        Festival Experiência Viva
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>