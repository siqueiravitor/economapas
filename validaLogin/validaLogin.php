<?php

$login = isset($_POST['login']) ? $_POST['login'] : "";
$senha = isset($_POST['senha']) ? md5($_POST['senha']) : "";

if ($login && $senha) {
    include "../app/config/connMysql.php";
    include "../app/config/config.php";

    $sql = "SELECT idusuario,
                   login,
                   senha
            FROM usuario
            WHERE login = '{$login}'
            AND ativo = 's'";
    $query = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        if ($senha == $row[2]) {
            session_start();
            $_SESSION['idlogin'] = $row[0];
            $_SESSION['login'] = $row[1];
            $_SESSION["tempo"] = time();

            mysqli_close($con);
            header("Location: ../app/index.php");
            return;
        } else {
            $alert = 1;
            $text = 'Senha inválida';
        }
    } else {
        $alert = 1;
        $text = 'Usuário inválido';
    }
} else {
    $alert = 1;
    $text = 'Digite um usuário e a senha';
}
header("Location: ../index.php?alert=$alert&text=$text");
