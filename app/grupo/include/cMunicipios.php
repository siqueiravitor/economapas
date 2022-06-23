<?php
include "../../config/config.php";
include "../../config/connMysql.php";

$idEstado = $_GET['idEstado'];

$select = "select idmunicipio, 
                  nome 
            from municipio
            where idestado = $idEstado";
$query = mysqli_query($con, $select);

?>
<label class="form-label">Cidade</label> 

<select class="form-control select2" name="cidade" >
    <?php
    while ($municipio = mysqli_fetch_array($query)) {
        echo "<option value='$municipio[0]'>$municipio[1]</option>";
    }
    ?>
</select>
