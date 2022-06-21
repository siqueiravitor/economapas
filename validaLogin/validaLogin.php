<?php

$login = isset($_POST['login']) ? $_POST['login'] : "";
$senha = isset($_POST['senha']) ? $_POST['senha'] : "";

if ($login && $senha) {
    include "../app/config/connMysql.php";
    include "../app/config/config.php";
    
    $manterLogin = isset($_POST['manterLogin']) ? $_POST['manterLogin'] : "";
    $senhaVisivel = isset($_POST['senhaVisivel']) ? $_POST['senhaVisivel'] : "";
}