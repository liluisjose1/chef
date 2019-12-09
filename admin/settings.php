<?php

include_once("./template/_header.php");


$sql = "SELECT * from settings";
$ejecutar = $conexion->query($sql);
$data = $ejecutar->fetch_row();
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <?php
        error_reporting(E_ALL ^ E_NOTICE);
        if ($_GET["error"] == "no") {
            echo "<div class='alert alert-primary alert-dismissable'>";
            echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
            echo "Actualizacion exitosa";
            echo "</div>";
        } else if ($_GET["error"] == "si") {
            echo "<div class='alert alert-danger alert-dismissable'>";
            echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
            echo "Error al registrar";
            echo "</div>";
        }
        ?>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Configuraciones</h4>
                        <br>
                        <form action="./operations/update_settings.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Nombre de la empresa </label>
                                        <input type="text" value="<?php echo $data[1]; ?>" class="form-control" name="nombre" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Telefono</label>
                                        <input type="text" value="<?php echo $data[2]; ?>" class="form-control" name="tel" placeholder="Telefono">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Stock Minimo</label>
                                        <input type="number" value="<?php echo $data[7]; ?>" min="1" class="form-control" name="stock" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">NIT</label>
                                        <input type="text" value="<?php echo $data[3]; ?>" class="form-control" name="nit" placeholder="NIT">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">NRC</label>
                                        <input type="text" value="<?php echo $data[4]; ?>" class="form-control" name="nrc" placeholder="NRC">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Dirección</label>
                                        <input type="text" value="<?php echo $data[5]; ?>" class="form-control" name="dir" placeholder="Direccion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Logo</label>
                                        <input type="file"  value="<?php echo $data[6]; ?>" class="form-control"  accept="image/png" name="icon" placeholder="Icono">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-gradient-primary mr-2">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./template/_footer.php") ?>