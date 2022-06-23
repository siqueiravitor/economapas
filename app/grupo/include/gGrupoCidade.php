<?php

include "../../config/config.php";

$idGrupo = isset($_POST['idGrupo']) ? $_POST['idGrupo'] : '';
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
$erro = 0;

if ($idGrupo && $cidade) {
    include "../../config/connMysql.php";

    $sqlVerficaQuantidade = "select 1 
                            from grupocidade 
                            where idgrupo = $idGrupo";
    $queryVerificaQuantidade = mysqli_query($con, $sqlVerficaQuantidade);

    if (mysqli_num_rows($queryVerificaQuantidade) < 5) {
        $sqlVerficaGrupoCidade = "select 1 
                            from grupocidade 
                            where idgrupo = $idGrupo 
                            and idmunicipio = $cidade";
        $queryVerificaGrupoCidade = mysqli_query($con, $sqlVerficaGrupoCidade);

        if (mysqli_num_rows($queryVerificaGrupoCidade) == 0) {
            $sql = "insert into grupocidade values(null, 
                                                    $idGrupo,
                                                    $cidade)";
            if (!mysqli_query($con, $sql)) {
                $erro++;
            }
        } else {
            $erro++;
            $alert = 1;
            $text = 'Cidade já vinculada ao grupo!';
        }
    } else {
        $erro++;
        $alert = 1;
        $text = 'Grupo já possui 5 cidades cadastradas!';
    }
}

if ($erro == 0) {
    $alert = 0;
    $text = "Cidade adicionada com sucesso!";
}

header("Location: ../?alert=$alert&text=$text&id=$idGrupo");
