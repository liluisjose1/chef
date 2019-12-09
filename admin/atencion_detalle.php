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
                        <form action="operations/atencion_save.php" method="post">
                        <input type="text" name="mesa" hidden value="<?php echo $_GET['m']; ?>">
                            <h4 class="card-title">Detalle de cuenta</h4>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Cliente</label>
                                        <input type="text" required name="cliente" 
                                            class="form-control" placeholder="Nombre de cliente">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Recetas </label>
                                        <?php
                                            $sql = "SELECT id,nombre from recetas";
                                            $ejecutar = $conexion->query($sql);
                                            echo("<select  id='insumos' class='form-control'>");
                                            echo("<option value=''>Seleccione un Receta</option>");
                                            while ($reg = $ejecutar->fetch_assoc()) {
                                                echo("<option value='$reg[id]'>$reg[nombre]</option>");
                                            }
                                            echo("</select>")
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Cantidad</label>
                                        <input type="number" min="1" class="form-control" id="cantidad" placeholder="1">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <br>
                                        <button type="button" id="add_product" class="btn btn-primary"
                                            title="Agregar"><span
                                                class="mdi mdi-format-annotation-plus"></span></button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th width="50">ID Insumo</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody id="result_users">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br><br>
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

    <script src="./assets/js/select2.js"></script>
    <script src="./assets/js/select2.full.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#insumos').select2();
            $('#insumos1').select2();
            var totalfinal = 0;
            $("#add_product ").click(function () {
                id_producto = $("#insumos option:selected").val();
                product_name = $("#insumos option:selected").html();
                cantidad = parseFloat($("#cantidad").val());
                if (id_producto != "") {
                    $('#result_users').append('<tr>' +
                        '<td ><input type="text" required readonly name="id_producto[]" class="form-control" value="' +
                        id_producto + '">' + '</td>' +
                        '<td ><input type="text" required readonly  class="form-control" value="' +
                        product_name + '">' + '</td>' +
                        '<td ><input type="text" required readonly name="cantidad[]" class="form-control" value="' +
                        cantidad + '">' + '</td>' +
                        '</tr>'
                    );
                } else {
                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debes de seleccionar insumos!',
                    })
                }
            });
        });
    </script>