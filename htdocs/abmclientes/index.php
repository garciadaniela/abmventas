<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (file_exists("clientes.txt")) {
    $jsonClientes = file_get_contents("clientes.txt");
    $aClientes = json_decode($jsonClientes, true);
} else {
    $aClientes = array();
}
//print_r($aClientes);
//exit;

$pos = isset($_GET["pos"]) ? $_GET["pos"] : "";

$btnInsertar = isset($_POST) ;

if ($_POST) {
    $dni = $_POST["txtDni"];
    $nombre = $_POST["txtNombre"];
    $telefono = $_POST["txtTelefono"];
    $correo = $_POST["txtCorreo"];



    if (isset($_GET["do"]) && $_GET["do"] == "editar") {
        //creo un array con los datos del cliente a editar
        $aClientes[$pos] = array(
            "dni" => $dni,
            "nombre" => $nombre,
            "telefono" => $telefono,
            "correo" => $correo
        );
    } else {
        //creo un array con los datos del cliente
        $aClientes[] = array(
            "dni" => $dni,
            "nombre" => $nombre,
            "telefono" => $telefono,
            "correo" => $correo
        );
    }


    //Covertimos el array en json
    $jsonClientes = json_encode($aClientes);
    //Guardamos el json en el archivo
    file_put_contents("clientes.txt", $jsonClientes);

    if($_POST["btnInsertar"]) {
      
    } else {
        $msg = "Guardado correctamente";
    }

} else if (isset($_GET["do"]) && $_GET["do"] == "editar") {
    $datosFormularioEditar = $aClientes[$pos];
}
if (isset($_GET["do"]) && $_GET["do"] == "delete") {
    unset($aClientes[$pos]);
    //Guardar en el archivo, el nuevo array de clientes modificado
    $jsonClientes = json_encode($aClientes);
    file_put_contents("clientes.txt", $jsonClientes);
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center py-3">
                <h1> Registro de Clientes </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="txtDni">DNI:</label>
                            <input type="text" name="txtDni" id="txtDni" class="form-control" required value="<?php echo isset($datosFormularioEditar["dni"]) ? $datosFormularioEditar["dni"] : ""; ?>">

                        </div>
                        <div class="col-12 form-group">
                            <label for="txtNombre">Nombre:</label>
                            <input type="text" name="txtNombre" id="txtNombre" class="form-control" required value="<?php echo isset($datosFormularioEditar["nombre"]) ? $datosFormularioEditar["nombre"] : ""; ?>">

                        </div>
                        <div class="col-12 form-group">
                            <label for="txtTelefono">Telefono:</label>
                            <input type="text" name="txtTelefono" id="txtTelefono" class="form-control" required value="<?php echo isset($datosFormularioEditar["telefono"]) ? $datosFormularioEditar["telefono"] : ""; ?>">

                        </div>
                        <div class="col-12 form-group">
                            <label for="txtCorreo">Correo:</label>
                            <input type="text" name="txtCorreo" id="txtCorreo" class="form-control" required value="<?php echo isset($datosFormularioEditar["correo"]) ? $datosFormularioEditar["correo"] : ""; ?>">

                        </div>


                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="btnInsertar" name="btnInsertar" class="btn btn-primary">Guardar</button>
                            <button type="reset" id="btnLimpiar" name="btnLimpiar" class="btn btn-secondary">Limpiar</button>


                        </div>
                    </div>
                    <?php if (isset($msg)) : ?>
                        <div class="alert alert-primary my-4" role="alert">
                            <?php echo $msg; ?>

                        </div>
                    <?php endif; ?>


                </form>

            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <a href="index.php?do=new"><i class="fas fa-user-plus"></i></a>
                    </div>
                </div>
                <table class="table table-hover border">
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>

                    </tr>

                    <?php

                    $pos = 0;
                    foreach ($aClientes as $pos => $cliente) {



                    ?>
                        <tr>
                            <td><?php echo $cliente["dni"]; ?></td>
                            <td><?php echo $cliente["nombre"]; ?></td>
                            <td><?php echo $cliente["correo"]; ?></td>
                            <td style="width: 110px; text-align: center;">
                                <a href="?pos=<?php echo $pos; ?>&do=editar"><i class="fas fa-edit"></i></a>
                                <a href="?pos=<?php echo $pos; ?>&do=delete"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php
                        $pos++;
                    }
                    ?>

                </table>

            </div>
        </div>
    </div>

</body>

</html>