<?php

include "../config/config.php";
include "../config/connMysql.php";

$estadosJson = file_get_contents('./estados.json', true);
$estados = json_decode($estadosJson, true);
$successEstado = 0;
$errorEstado = 0;
$text = '';

foreach ($estados as $estado) {
    $idEstado = $estado['id'];
    $nome = $estado['nome'];
    $sigla = $estado['sigla'];

    $selectEstado = "select 1 from estado where id = $idEstado";
    $queryEstado = mysqli_query($con, $selectEstado);

    if (mysqli_num_rows($queryEstado) == 0) {
        $insertEstado = "insert into estado values (null,
                                                $idEstado,
                                                '$nome',
                                                '$sigla')";
        if (mysqli_query($con, $insertEstado)) {
            $successEstado++;
        } else {
            $errorEstado++;
        }
    }
}

$selectEstados = "select idestado, id from estado";
$queryEstados = mysqli_query($con, $selectEstados);

$successMunicipio = 0;
$errorMunicipio = 0;

while ($rowEstados = mysqli_fetch_array($queryEstados)) {
    $idEstadoBD = $rowEstados[0];
    $idEstado = $rowEstados[1];

    $municipiosJson = file_get_contents("https://servicodados.ibge.gov.br/api/v1/localidades/estados/$idEstado/municipios", true);
    $municipios = json_decode($municipiosJson, true);
    foreach ($municipios as $municipio) {
        $nomeMunicipio = $municipio['nome'];

        $selectMunicipio = "select 1 
                            from municipio 
                            where idestado = $idEstadoBD
                            and nome = '$nomeMunicipio'";

        $queryMunicipio = mysqli_query($con, $selectMunicipio);

        if ($queryMunicipio) {
            if (mysqli_num_rows($queryMunicipio) == 0) {
                $insertMunicipio = "insert into municipio values (null,
                                                            $idEstadoBD,
                                                            '$nomeMunicipio')";
                if (mysqli_query($con, $insertMunicipio)) {
                    $successMunicipio++;
                } else {
                    $errorMunicipio++;
                }
            }
        }
    }
}
if ($errorEstado == 0) {
    $alert = 0;
    $text .= 'Estados importados com sucesso!';
} elseif ($successEstado > 0 && $errorEstado > 0) {
    $alert = 1;
    $text .= 'Alguns estados importados com sucesso!';
} else {
    $alert = 3;
    $text .= 'Erro ao importar estados!';
}

$text .= " ";

if ($errorMunicipio == 0) {
    $alert = 0;
    $text .= 'Municípios importados com sucesso!';
} elseif ($successMunicipio > 0 && $errorMunicipio > 0) {
    $alert = 1;
    $text .= 'Alguns municípios importados com sucesso!';
} else {
    $alert = 3;
    $text .= 'Erro ao importar municípios!';
}

header("Location: ../home?alert=$alert&text=$text");

