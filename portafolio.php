<?php include "cabecera.php" ?>
<?php include "conexion.php" ?>

<?php

// INSERT
if ($_POST) {
    $nombre = $_POST["nombre"];
    $imagen = $_FILES["archivo"]["name"];
    $descripcion = $_POST["descripcion"];
    $objConexion = new Conexion();
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion')";
    $objConexion->ejecutar($sql);
}

// DELETE
if ($_GET) {
    $id = $_GET["borrar"];
    $objConexion = new Conexion();
    $sql = "DELETE FROM `proyectos` WHERE `proyectos`.`id` =" . $id;
    $objConexion->ejecutar($sql);
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
                        Nombre del proyecto <input class="form-control" type="text" name="nombre" id="">
                        <br>
                        Imagen del proyecto <input class="form-control" type="file" name="archivo" id="">
                        <br>
                        <textarea class="form-control" name="descripcion" id="" cols="30" rows="3"></textarea>
                        <br>
                        <input class="btn btn-success" type="submit" value="Enviar proyecto">
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
                            <td><?php echo $proyecto["imagen"]; ?></td>
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