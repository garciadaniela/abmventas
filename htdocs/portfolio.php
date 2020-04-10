<?php $pg ="proyecto"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <script src="js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!--Menu de navegacion -->
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/estilos.css"> <!-- siempre mis estilos al final-->
    <title>Proyectos</title>
</head>

<body>
    <header>
    <?php 
    include_once("menu.php");

    ?>

    </header>
    <section id="proyecto">
        <div class="container p-4">
            <div class="row">
                <div class="col-12">
                    <h1> Mis proyectos</h1>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <h2> Estos son algunos de los trabajos que he realizado:</h2>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6 col-12 pr-3">
                    <div class="bg-white">
                    <img src="images/abmventas.png" alt="ABM Ventas" class="img-fluid">
                    <div class="col-12">
                        <h3>ABM Clientes</h3>
                    </div> 
                    <div class="col-12">
                        <p> Sistema de gestión de clientes, productos y ventas. Realizado en HTML, CSS, PHP, MVC, Bootrap, Js, Ajax, jQuery y MySQL de base de datos.</p>
                    </div>
                    <div class="row p-3">
                    <div class="col-6">
                        <a href="#" class="btn" target="_blank"> Ver online</a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" target="_blank"> Código fuente</a>

                    </div>
                    </div>
                    </div>
                </div>
                <div class="col-sm-6 col-12 pl-3 mt-4 mt-sm-0">
                    <div class="bg-white">
                    <img src="images/sistema-admin.png" alt="sistema-admin" class="img-fluid">
                    <div class="col-12">
                        <h3>Sistema de gestión</h3>
                    </div> 
                    <div class="col-12">
                        <p> Sistema de gestión de clientes, productos y ventas. Realizado en HTML, CSS, PHP, MVC, Bootrap, Js, Ajax, jQuery y MySQL de base de datos.</p>
                    </div>
                    <div class="row p-3">
                    <div class="col-6">
                        <a href="#" class="btn" target="_blank"> Ver online</a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" target="_blank"> Código fuente</a>

                    </div>
                    </div>
                    </div>
                </div>

                
            </div>


        </div>

    </section>
    <footer>
    <?php
    include_once("footer.php");


    ?>
    
    
      </footer>
</body>

</html>