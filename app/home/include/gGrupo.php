<?php

include "../../config/config.php";

$nomeGrupo = isset($_POST['nomeGrupo']) ? $_POST['nomeGrupo'] : '';
$erro = 0;
if (!empty(trim($nomeGrupo))) {
    include "../../config/connMysql.php";

    $sqlVerficaNomeGrupo = "select 1 from grupo where nome = '$nomeGrupo'";
    $queryVerificaNomeGrupo = mysqli_query($con, $sqlVerficaNomeGrupo);

    if (mysqli_num_rows($queryVerificaNomeGrupo) == 0) {
        $sql = "insert into grupo values(null, {$_SESSION['idlogin']}, '$nomeGrupo')";
        if(!mysqli_query($con, $sql)){
            $erro++;
        } else {
            $grupoId = mysqli_insert_id($con);
        }
    } else {
        $erro++;
        $alert = 1 ;
        $text = 'Nome de grupo já cadastrado!';
    }
}
if($erro == 0){
    $alert = 0;
    $text = "Grupo criado com sucesso";
    header("Location: ../../grupo?alert=$alert&text=$text&id=$grupoId");
} else {
    header("Location: ../?alert=$alert&text=$text");
}
