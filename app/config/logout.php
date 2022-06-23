<?php

include "../config/config.php";

session_destroy();
$alert = 0;
$text = "Deslogado com sucesso!";
header("Location: ../../?alert=$alert&text=$text");
