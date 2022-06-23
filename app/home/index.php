<?php
include "../config/config.php";
include "../config/connMysql.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Economapas</title>

        <!-- JQuery -->
        <script src="../../vendor/jquery/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap -->
        <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <!-- DataTable -->
        <link href="../../vendor/dataTable/css/dataTable.min.css" rel="stylesheet" type="text/css">

        <style>
            body{
                background-color: #f1f5f7;
            }
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
        </style>
        <script>
            $(document).ready(function () {
                $("#tabelaGrupos").dataTable({
                    'language': {
                        url: "../../vendor/dataTable/ptbr/pt-BR.json"
                    },
                });

                setTimeout(() => {
                    $("#msg").hide();
                }, 6000)
            });

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

            <div class="col-lg-3 col-md-11 col-sm-11 mb-3">
                <div class="card">
                    <div class="card-header text-center title">
                        Criar grupo
                    </div>

                    <div class="card-body" id='criar'>
                        <form method="POST" action="./include/gGrupo.php">
                            <div>
                                <label class="form-label">Nome do grupo</label> 
                                <input class="form-control" name="nomeGrupo" placeholder="Nome do grupo">
                            </div>
                            <div class='text-center mt-4'>
                                <button class='btn btn-success'>Criar grupo</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>


            <div class="col-lg-7 col-md-11 col-sm-11 mb-3">
                <div class="card">

                    <div class="card-header text-center title">
                        Grupos de países
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table dataTable table-hover table-sm" id="tabelaGrupos">
                            <thead>
                                <tr>
                                    <th class='text-center'>Grupo</th>
                                    <th class='text-center'>Cidades vinculadas</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = "select g.nome, count(gc.idgrupocidade) as qtdcidades, g.idgrupo
                                            from grupo g
                                            left join grupocidade gc on (g.idgrupo = gc.idgrupo)
                                            where idusuario = {$_SESSION['idlogin']}
                                            group by g.idgrupo
                                            order by g.idgrupo asc";
                                $query = mysqli_query($con, $select);
                                while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td class='text-center'><?= $row[0] ?></td>
                                        <td class='text-center'><?= $row[1] ?></td>
                                        <td class="text-center">
                                            <a href="../grupo/?id=<?= $row[2] ?>"
                                               class="btn btn-primary btn-sm">
                                                Visualizar
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="./include/eGrupo.php?id=<?= $row[2] ?>"
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
    <!-- DataTable -->
    <script src="../../vendor/dataTable/js/dataTable.min.js"></script>
</html>
