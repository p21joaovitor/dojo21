<?php

require_once '../vendor/autoload.php';

use App\Router\Router;

(new Router())->route();

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
    <section class="form text-center">
        <h2>Login</h2>
        <form method="POST" id="login-form" >
            <div class="">
                <label for="email">
                    <span>Email: </span>
                    <input type="email" placeholder="Digite aqui o e-mail" id="email" name="email" value=""  autofocus>
                </label>
            </div>
            <div>
                <label for="password">
                    <span>Senha: </span>
                    <input type="password" placeholder="Digite aqui a senha" id="password" name="password" value="" >
                </label>
            </div>

            <div>
                <button class="btn" type="submit">
                    Logar
                </button>
            </div>
        </form>
        <a href="cadastro.php" class="btn">Cadastrar</a>
    </section>
</main>



<footer></footer>

<script src="assets/jQuery/jquery-3.7.0.min.js" type="text/javascript"></script>
<script src="assets/js/user.js" type="text/javascript"></script>
<script src="assets/js/objective.js" type="text/javascript"></script>
<script src="assets/js/login.js" type="text/javascript"></script>
</body>
</html>

