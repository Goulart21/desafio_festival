<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/AtividadeModel.php';
require_once __DIR__ . '/../services/AtividadeService.php';

$service = new Atividadeservice($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome_atividade = $_POST['nome_atividade'];
    $descricao = $_POST['descricao'];
    $data_atividade = $_POST['data_atividade'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];
    $local_atividade = $_POST['local_atividade'];
    $capacidade = $_POST['capacidade'];

    $atividade = new AtividadeModel($nome_atividade, $descricao, $data_atividade, $hora_inicio, $hora_fim, $local_atividade, $capacidade);

    if (isset($_POST['id_atividade'])) {

        $id = (int) $_POST['id_atividade'];
        $resultado = $service->atualizarAtividade($id, $atividade);
        header('Location: atividades.php?mensagem= ' . $resultado);
    } else {

        $resultado = $service->cadastrarAtividade($atividade);

        header('Location: atividades.php?mensagem= ' . $resultado);
        exit;
    }
}

$atividades = $service->listarAtividade();

if (isset($_GET['excluir'])) {

    $id = (int) $_GET['excluir'];
    $resultado = $service->excluir($id);

    header('Location: atividade.php?mensagem= ' . $resultado);
    exit;
}

$atividadeEditar = null;

if (isset($_GET['atualizarAtividade'])) {

    $id_atividade = (int) $_GET['atualizarAtividade'];
    $atividadeEditar = $service->buscarAtividadePorId($id_atividade);
}

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Participantes</title>
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

    <main>

        <?php if (isset($_GET['mensagem'])): ?>

            <?php if ($_GET['mensagem'] === 'SUCESSO'): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    Ativdade Cadastrada
                    <button type="button" class="btn-close" data-bs-dimiss="alert" aria-label="Fechar"></button>
                </div>

            <?php elseif ($_GET['mensagem'] === 'ATUALIZADO'): ?>

                <div class="alert alert-success alert-dismissible fades show">
                    Atividade Atualizada

                    <button type="button" class="btn-close" data-bs-dimiss="alert" aria-label="Fechar"></button>
                </div>

            <?php elseif ($_GET['mensagem'] === 'EXCLUIDO'): ?>

                <div class="alert alert-success alert-dismissible fades show">
                    Atividade Deletada

                    <button type="button" class="btn-close" data-bs-dimiss="alert" aria-label="Fechar"></button>
                </div>

            <?php elseif ($_GET['mensagem'] === 'POSSUI_INSCRICOES'): ?>

                <div class="alert alert-success alert-dismissible fades show">
                    Não é possivel excluir essa atividade, contem inscrições
                    <button type="button" class="btn-close" data-bs-dimiss="alert" aria-label="Fechar"></button>
                </div>


            <?php endif; ?>
        <?php endif; ?>

        <section class="mt-4 mb-5">
            <h2 class="text-center mb-4">Cadastro de Atividade</h2>

            <div class="row justify-content-center">

                <div class="col-md-8 col-lg-6">

                    <form action="" method="post">

                        <?php if ($atividadeEditar): ?>
                            <input type="hidden" name="id_atividade" value="<?= $atividadeEditar['id_atividade'] ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="nome_atividade" class="form-label">Nome da Atividade</label>
                            <input type="text" name="nome_atividade" id="nome_atividade" class="form-control" value="<?= htmlspecialchars($atividadeEditar['nome_atividade'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nome_atividade" class="form-label">Descricao</label>
                            <input type="text" name="descricao" id="descricao" class="form-control" value="<?= htmlspecialchars($atividadeEditar['descricao'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nome_atividade" class="form-label">Data Atividade:</label>
                            <input type="date" name="data_atividade" id="nome_atividade" class="form-control" value="<?= $atividadeEditar['data_atividade'] ?? '' ?>" required>
                        </div>


                        <div class="mb-3">
                            <label for="nome_atividade" class="form-label">Horario de inicio</label>
                            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="<?= $atividadeEditar['hora_inicio'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nome_atividade" class="form-label">Horario de termino</label>
                            <input type="time" name="hora_fim" id="hora_fim" class="form-control" value="<?= $atividadeEditar['hora_fim'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nome_atividade" class="form-label">Local:</label>
                            <input type="text" name="local_atividade" id="local_atividade" class="form-control" value="<?= $atividadeEditar['local_atividade'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="capacidade" class="form-label">Capacidade</label>
                            <input type="number" name="capacidade" id="capacidade" class="form-control" value="<?= $atividadeEditar['capacidade'] ?? '' ?>" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">
                                <?= $atividadeEditar ? 'Atualizar' : 'Cadastrar' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="mb-4 text-center">Ativade Cadastradas</h2>

            <div class="table-responsive">
                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>Horario de Inicio</th>
                            <th>Horario de Termino</th>
                            <th>Local da Atividade</th>
                            <th>Capacidade</th>
                            <th>Ações</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($atividades as $atividade): ?>

                            <tr>
                                <td><?= $atividade['nome_atividade'] ?></td>
                                <td><?= $atividade['descricao'] ?></td>
                                <td><?= $atividade['data_atividade'] ?></td>
                                <td><?= $atividade['hora_inicio'] ?></td>
                                <td><?= $atividade['hora_fim'] ?></td>
                                <td><?= $atividade['local_atividade'] ?></td>
                                <td><?= $atividade['capacidade'] ?></td>

                                <td>
                                    <a href="atividades.php?atualizarAtividade=<?= $atividade['id_atividade'] ?>" class="btn btn-warning">Editar</a>
                                    <a href="atividades.php?excluir=<?= $atividade['id_atividade'] ?>" class="btn btn-danger">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>