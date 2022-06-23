<?php

include "../../config/config.php";
include "../../config/connMysql.php";

$idGrupoCidade = isset($_GET['id']) ? $_GET['id'] : '';
$idGrupo = isset($_GET['idGrupo']) ? $_GET['idGrupo'] : '';

$sql = "delete from grupocidade where idgrupocidade = $idGrupoCidade";

if (mysqli_query($con, $sql)) {
    $alert = 0;
    $text = "Cidade removida com sucesso!";
} else {
    $alert = 1;
    $text = "Erro ao remover cidade!";
}

header("Location: ../?alert=$alert&text=$text&id=$idGrupo");
