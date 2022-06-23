<?php

include "../../config/config.php";
include "../../config/connMysql.php";
$idGrupo = isset($_GET['id']) ? $_GET['id'] : '';
$erro = 0;

$sqlDeleteGrupoCidade = "delete from grupocidade where idgrupo = $idGrupo";

if (mysqli_query($con, $sqlDeleteGrupoCidade)) {
    $sqlDeleteGrupo = "delete from grupo where idgrupo = $idGrupo";
    if (!mysqli_query($con, $sqlDeleteGrupo)) {
        $erro++;
    }
} else {
    $erro++;
}

if ($erro == 0) {
    $alert = 0;
    $text = "Grupo removido com sucesso!";
} else {
    $alert = 1;
    $text = "Erro ao deletar grupo!";
}
header("Location: ../?alert=$alert&text=$text");
