<?php

require_once "../vendor/autoload.php";

session_start();

use App\Model\ObjectiveModel;

$objectiveModel = new ObjectiveModel();

$objectives = $objectiveModel->list($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
    <title>O que é o OKR</title>
</head>
<body>
<header></header>
<nav>

</nav>
<main class="container">
    <section>
        <h1>Adicionar key results</h1>

    </section>

    <section>
        <form method="POST" id="key-result-form">
            <div class="">
                <label for="title">
                    <span>Título: </span>
                    <input type="text" name="title" id="title" value="">
                </label>
            </div>

            <div class="">
                <label for="objective">
                    <span>Objetivo: </span>
                    <select name="objective_id" id="objective_id">
                        <?php foreach ($objectives as $objective) : ?>
                            <option value="<?= $objective['id']; ?>"><?= $objective['title']; ?></option>
                        <?php endforeach;?>
                    </select>
                </label>
            </div>

            <div class="">
                <label for="description">
                    <span>Descrição: </span>
                    <input type="text" id="description" name="description">
                </label>
            </div>

            <div class="">
                <label for="type">
                    <span>Tipo: </span>
                    <select id="type" name="type">
                        <option value="1">Milestone</option>
                        <option value="2">Porcentagem</option>
                    </select>
                </label>
            </div>

            <div>
                <button class="btn" type="submit">
                    Enviar
                </button>
            </div>
        </form>
    </section>
</main>



<footer></footer>

<script src="assets/jQuery/jquery-3.7.0.min.js" type="text/javascript"></script>
<script src="assets/js/key-results.js" type="text/javascript"></script>
</body>
</html>