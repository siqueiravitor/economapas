<?php

session_start();

if (isset($_GET['alert'])) {
    switch ($_GET['alert']) {
        case 0:
            $alert = 'green';
            break;
        case 1:
            $alert = 'red';
            break;
        case 2:
            $alert = 'orange';
            break;
        default:
            $alert = '';
    }
}

// Padrão brasileiro
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
//Valida a Sessão
if (!isset($_SESSION['idlogin'])) {
    $alert = 1;
    $text = "Necessário realizar login para continuar";

    header("Location: ../../?alert=$alert&text=$text");
} elseif ($_SESSION["tempo"] + 60 * 60 < time()) {
    session_destroy();
    $alert = 1;
    $text = "Sessão expirada";
    header("Location: ../../?alert=$alert&text=$text");
} else {
    $_SESSION["tempo"] = time();
}