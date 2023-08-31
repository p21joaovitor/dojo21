<?php

require_once "../vendor/autoload.php";

session_start();

use App\Http\Controller\KeyResult;
use App\Model\KeyResultModel;
use App\Model\ObjectiveModel;

$objectiveModel = new ObjectiveModel();
$keyResultsModel = new KeyResultModel();

$objectives = $objectiveModel->list($_SESSION['user_id']);

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
    <title>Meus objetivos</title>
</head>
<body>
<header></header>
<nav>

</nav>
<main class="container">
    <section class="meus-objetivos">
        <h1>Meus objetivos</h1>
        <?php foreach ($objectives as $objective): ?>
            <div class="objetivo">
                <?php $keyResults = $keyResultsModel->list($objective['id']); ?>
                <h3>Título: <?php echo $objective['title']; ?></h3>
                <h4>Descrição: <?php echo $objective['description']; ?></h4>

                <h4>Key Results:</h4>
                <ul>
                    <?php foreach ($keyResults as $keyResult): ?>
                        <li><strong><?php echo $keyResult['title']; ?></strong></li>
                        <ul>
                            <li><strong>Descrição</strong>: <?=$keyResult['description']?></li>
                            <li><strong>Tipo</strong>: <?= $keyResult['type'] === 1 ? 'Milestone' : 'Porcentagem'   ?></li>
                        </ul>
                    <?php endforeach; ?>
                </ul>
            </div>

        <hr>
        <?php endforeach; ?>
    </section>
</main>


<footer></footer>
<script src="assets/jQuery/jquery-3.7.0.min.js" type="text/javascript"></script>
<script src="assets/js/key-results.js" type="text/javascript"></script>
</body>
</html>