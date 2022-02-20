<?php include "cabecera.php" ?>
<?php include "conexion.php" ?>

<?php

// INSERT
if ($_POST) {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];

    //Obtenemos fecha
    $fecha = new DateTime();
    // Nombre de la imagen
    $imagen = $fecha->getTimestamp() . "_" . $_FILES["archivo"]["name"];
    // Imagen temporal
    $imagen_temporal = $_FILES["archivo"]["tmp_name"];
    // Mueve el archivo temporal a la carpeta imagenes (no olvidar dar permisos)
    move_uploaded_file($imagen_temporal, "imagenes/" . $imagen);

    $objConexion = new Conexion();
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion')";
    $objConexion->ejecutar($sql);
    header("location: portafolio.php");
}

// DELETE
if ($_GET) {
    $id = $_GET["borrar"];
    $objConexion = new Conexion();

    // Obteniendo la imagen a eliminar con un select
    $imagen = $objConexion->consultar("SELECT imagen FROM `proyectos` WHERE id=" . $id);
    // Eliminar imagen con el metodo unlink
    unlink("imagenes/" . $imagen[0]["imagen"]);
    // Eliminar nombre de imagen de la tabla (ojo que es diferente a eliminar la imagen literalmente)
    $sql = "DELETE FROM `proyectos` WHERE `proyectos`.`id` =" . $id;
    $objConexion->ejecutar($sql);
    header("location: portafolio.php");
}

// SELECT 
$objConexion = new Conexion();
$sql = "SELECT * FROM `proyectos`";
$proyectos = $objConexion->consultar($sql);

?>

<br>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Datos del proyecto
                </div>
                <div class="card-body">
                    <form action="portafolio.php" method="POST" enctype="multipart/form-data">
                        Nombre del proyecto <input required class="form-control" type="text" name="nombre" id="">
                        <br>
                        Imagen del proyecto <input required class="form-control" type="file" name="archivo" id="">
                        <br>
                        <textarea required class="form-control" name="descripcion" id="" cols="30" rows="3"></textarea>
                        <br>
                        <input required class="btn btn-success" type="submit" value="Enviar proyecto">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Controles</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Recorre la variable proyectos, el cual es un select de la tabla proyectos -->
                    <?php foreach ($proyectos as $proyecto) { ?>
                        <tr>
                            <td><?php echo $proyecto["id"]; ?></td>
                            <td><?php echo $proyecto["nombre"]; ?></td>
                            <td><img width="100" src="imagenes/<?php echo $proyecto["imagen"]; ?>" alt=""></td>
                            <td><?php echo $proyecto["descripcion"]; ?></td>
                            <td><a class="btn btn-danger" href="?borrar=<?php echo $proyecto["id"]; ?>">Eliminar</a></td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "pie.php"; ?>