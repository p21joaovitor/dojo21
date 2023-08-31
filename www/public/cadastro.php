<?php

require_once '../vendor/autoload.php';

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
    <section class="text-center">
        <h2>Criar usuário</h2>
        <form method="POST" id="user-form">
            <div class="">
                <label for="nome">
                    <span>Nome: </span>
                    <input type="text" name="name" id="name" value="">
                </label>
            </div>
            <div class="">
                <label for="email">
                    <span>Email: </span>
                    <input type="email" id="email" name="email" value="email@email.com">
                </label>
            </div>
            <div>
                <label for="password">
                    <span>Senha: </span>
                    <input type="password" id="password" name="password" value="123456789">
                </label>
            </div>

            <div>
                <button type="submit" class="btn">
                    ENVIAR
                </button>
            </div>
        </form>
    </section>
</main>
<footer></footer>
<script src="assets/jQuery/jquery-3.7.0.min.js" type="text/javascript"></script>
<script src="assets/js/login.js" type="text/javascript"></script>
</body>
</html>

