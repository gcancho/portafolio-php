<?php

session_start();

// Imprime todas las variables de sesion
// print_r($_SESSION["usuario"]);

/* Esta cabecera se encuentra en todas las paginas excepto la del login.php y cerrar.php, por lo cual
es una seguridad basica ya que no permitira acceder a las paginas si esque no se inicia sesion antes */
if (isset($_SESSION["usuario"]) != "gio") {
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Portafolio con PHP</title>
</head>

<body>

    <div class="container">

        <a href="index.php">Inicio</a>
        <a href="portafolio.php">Portafolio</a>
        <a href="cerrar.php">Cerrar</a>
        <br>