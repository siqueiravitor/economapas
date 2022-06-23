<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Desafio Economapas</title>

        <!-- JQuery -->
        <script src="./vendor/jquery/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap -->
        <link href="./vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">

        <style>
            body{
                background-color: #f2f4f6;
                justify-content: center;
                align-items: center;
                display: flex;
                height: 100vh;
                padding: 0;
                margin: 0;
            }
            h5{
                margin-bottom: 15px;
                padding-bottom: 10px;
                border-bottom: 1px solid #ddd;
                font-family: monospace;
                text-align: center;
            }
            .card{
                margin: 15px;
                box-shadow: 0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06);
                border: none;
                padding: 1.5rem 3rem 2rem 3rem;
            }
            .form-group{
                margin-bottom: 1rem;
            }
            .form-label{
                font-weight: 600;
                margin-bottom: .2rem
            }
            #accessButon{
                color: #fff;
                background-color: #1f2937;
                border-color: #1f2937;
                box-shadow: inset 0 1px 0 hsl(0deg 0% 100% / 15%),
                    0 1px 1px rgb(17 24 39 / 8%);
            }
            .form-check-label{
                color: #777;
            }

            form{
                width: 35vw
            }
            @media screen and (max-width: 1050px){
                form{
                    width: 50vw
                }
            }
            @media screen and (max-width: 750px){
                .card{
                    margin: 0px;
                    padding: 2rem
                }
                form{
                    width: 75vw
                }
            }
            @media screen and (max-width: 430px){
                #options{
                    font-size: 0.8rem
                }
            }
            @media screen and (max-width: 350px){
                .card{
                    margin: 0px;
                    padding: 1rem
                }
                form{
                    width: 75vw
                }
            }
        </style>
        <script>
            function senhaVisivel() {
                if ($("#senha")[0].type === 'password') {
                    $("#senha").attr('type', 'text');
                } else {
                    $("#senha").attr('type', 'password');
                }
            }
            $(document).ready(function () {
                setTimeout(() => {
                    $("#msg").hide();
                }, 6000)
            });
        </script>
    </head>
    <body>
        <form method="POST" action="./validaLogin/validaLogin.php">
            <div class="card">
                <?php
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
                        <div class="w-100 text-center d-flex justify-content-center mb-4">
                            <div class="rounded" style="padding: 1rem 2rem;width: 35rem; background-color: <?= $alert ?>; color: #fff; font-weight: 600;">
                                <span><?= $_GET['text'] ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <h5>Acesso ao sistema</h5>

                <div class="form-group">
                    <label class="form-label">Login:</label> 
                    <input class='form-control' placeholder="Login" name="login" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Senha:</label> 
                    <input id="senha" class='form-control' placeholder="Senha" name="senha" type="password" required>
                </div>

                <div id='options' class="d-flex justify-content-end form-group">
                    <div>
                        <input type="checkbox" onchange="senhaVisivel()" class="form-check-input">
                        <span class='form-check-label'>Mostrar senha</span>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" id='accessButon' class="btn">Sign in</button>
                </div>
            </div>
        </form>
    </body>

    <!--Bootstrap-->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
</html>