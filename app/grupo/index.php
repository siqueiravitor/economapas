<?php
include "../config/config.php";
include "../config/connMysql.php";

$grupoId = $_GET['id'];

$sqlGrupoNome = "select nome from grupo where idgrupo = $grupoId";
$queryGrupoNome = mysqli_query($con, $sqlGrupoNome);
$grupoNome = mysqli_fetch_array($queryGrupoNome)[0];

if (!$grupoId || !isset($grupoNome)) {
    $alert = 2;
    $text = "Grupo não encontrado";
    header("Location: ../home?alert=$alert&text=$text");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Economapas - Grupo</title>

        <!-- JQuery -->
        <script src="../../vendor/jquery/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap -->
        <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <!-- select2 css -->
        <link href="../../vendor/select2/css/select2.min.css" rel="stylesheet" type="text/css">
        <!-- DataTable -->
        <link href="../../vendor/dataTable/css/dataTable.min.css" rel="stylesheet" type="text/css">

        <style>
            body{
                background-color: #f1f5f7;
                /*cursor: wait !important;*/
            }
            /*            body *{
                            pointer-events: none;
                        }*/
            .title{
                font-size: 1.2rem;
                font-weight: 600;
            }
            #criar * {
                margin-bottom: .3rem;
            }

            #criar label{
                font-weight: 600;
                margin-bottom: .2rem
            }
            tbody tr td:first-child{
                vertical-align: middle;
            }
        </style>
        <script>
            $(document).ready(function () {
                $("#tabelaGrupos").dataTable({
                    'language': {
                        url: "../../vendor/dataTable/ptbr/pt-BR.json"
                    }
                });
                $(".select2").select2();

                setTimeout(() => {
                    $("#msg").hide();
                }, 6000)
            });

            function carregaMunicipios(idEstado) {
                console.log(idEstado)
                let url = "./include/cMunicipios.php?";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        idEstado
                    },
                    datatype: 'HTML',
                    success: function (data) {
                        $("#municipio").html(data);
                        $(".select2").select2();
                    },
                    error: function (data) {
                        console.log("ERRORR")
                    },
                    beforeSend: function () {
                        $("#municipio").html(`
                            <label class="form-label">Cidade</label> 

                            <div class='form-control'>
                              Carregando...  
                            </div>
                        `);

                    }
                });
            }
        </script>
    </head>

    <body>
        <?php
        include "../include/navbar.php";
        if (isset($_GET['alert']) && isset($_GET['text'])) {
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
            ?>
            <div id="msg">
                <div class="w-100 text-center d-flex justify-content-center mt-4">
                    <div class="rounded" style="padding: 1rem 2rem;width: 35rem; background-color: <?= $alert ?>; color: #fff; font-weight: 600;">
                        <span><?= $_GET['text'] ?></span>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="d-flex justify-content-center mt-5 row">

            <div class="col-lg-4 col-md-11 col-sm-11 mb-3">
                <div class="card">
                    <div class="card-header text-center title">
                        Adicionar cidade ao grupo - <?= $grupoNome ?>
                    </div>

                    <div class="card-body" id='criar'>

                        <form method="POST" action="./include/gGrupoCidade.php">
                            <input hidden value="<?= $grupoId ?>" name="idGrupo">
                            <div>
                                <label class="form-label">Estado</label> 
                                <select class="form-control select2" name="estado" onchange="carregaMunicipios(this.value)">
                                    <?php
                                    $sqlEstado = "select idestado, 
                                                        nome, 
                                                        sigla
                                                from estado";
                                    $queryEstado = mysqli_query($con, $sqlEstado);
                                    if (mysqli_num_rows($queryEstado) > 0) {
                                        echo "<option>Selecione o estado</option>";

                                        while ($estado = mysqli_fetch_array($queryEstado)) {
                                            $idEstado = $estado[0];
                                            $nomeEstado = "{$estado[2]} - {$estado[1]}";

                                            echo "<option value='$idEstado'>$nomeEstado</option>";
                                        }
                                    } else {
                                        echo "<option>Dados não importados</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="municipio">
                                <label class="form-label">Cidade</label> 

                                <select class="form-control select2">
                                    <option>Selecione um estado</option>
                                </select>
                            </div>
                            <div class='mt-4 d-flex justify-content-between'>
                                <a class='btn btn-secondary' href='../home'>Voltar</a>
                                <button class='btn btn-success'>Adicionar cidade</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>


            <div class="col-lg-6 col-md-11 col-sm-11 mb-3">
                <div class="card">

                    <div class="card-header text-center title">
                        Cidades do grupo - <?= $grupoNome ?>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table dataTable table-hover table-sm" id="tabelaGrupos">
                            <thead>
                                <tr>
                                    <th>Município</th>
                                    <th>UF</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = "select idgrupocidade, 
                                                  m.nome, 
                                                  e.sigla
                                           from grupocidade gc
                                           inner join municipio m on (gc.idmunicipio = m.idmunicipio)
                                           inner join estado e on (e.idestado = m.idestado)
                                           where idgrupo = $grupoId";
                                $query = mysqli_query($con, $select);
                                while ($cidade = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?= $cidade[1] ?></td>
                                        <td><?= $cidade[2] ?></td>
                                        <td class="text-center" style="width: 5%">
                                            <a href="include/eGrupoCidade.php?id=<?= $cidade[0] ?>&idGrupo=<?= $grupoId ?>"
                                               class="btn btn-danger btn-sm">
                                                Remover
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </body>

    <!-- Bootstrap -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- select 2 plugin -->
    <script src="../../vendor/select2/js/select2.min.js"></script>
    <!-- DataTable -->
    <script src="../../vendor/dataTable/js/dataTable.min.js"></script>
</html>
