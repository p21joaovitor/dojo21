<?php

$host = 'mysql';
$database = 'okr';
$user = 'root';
$password = 'root';

$dsn = "mysql:host=$host;dbname=$database";

try {
    $pdoConnection = new PDO($dsn, $user, $password);
    $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdoConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    if ($pdoConnection) {
        echo "Sucesso!";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
