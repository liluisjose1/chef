<?php

include_once("./template/_header.php");


?>
<style>
    .select2-selection__rendered {
        line-height: 40px !important;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-selection__arrow {
        height: 40px !important;
    }
</style>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <?php
        error_reporting(E_ALL ^ E_NOTICE);
        if ($_GET["error"] == "no") {
            echo "<div class='alert alert-primary alert-dismissable'>";
            echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
            echo "Compra realizada con exito";
            echo "</div>";
        } else if ($_GET["error"] == "si") {
            echo "<div class='alert alert-danger alert-dismissable'>";
            echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
            echo "Error al registrar la compra";
            echo "</div>";
        }
        ?>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="reports/reporte_ingresos.php" target="_blank" method="post">
                            <h4 class="card-title">Reporte de Ingresos</h4>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Fecha Desde</label>
                                        <input type="date" required name="fecha_desde" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Fecha Hasta</label>
                                        <input type="date" required name="fecha_hasta" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-gradient-primary mr-2">Procesar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./template/_footer.php") ?>