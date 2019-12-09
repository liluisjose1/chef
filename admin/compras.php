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
                        <form action="operations/compra_save.php" method="post">
                            <h4 class="card-title">Compras</h4>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Proveedor </label>
                                        <?php
                                            $sql = "SELECT id,nombre from proveedores";
                                            $ejecutar = $conexion->query($sql);
                                            echo("<select required name='proveedor' id='proveedor' class='form-control'>");
                                            echo("<option value=''>Seleccione un proveedor</option>");
                                            while ($reg = $ejecutar->fetch_assoc()) {
                                                echo("<option value='$reg[id]'>$reg[nombre]</option>");
                                            }
                                            echo("</select>")
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Forma de Pago</label>
                                        <select name="forma_pago" class="form-control" required id="">
                                            <option value="">Seleccione una opcion</option>
                                            <option value="1">Contado</option>
                                            <option value="2">Crédito</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Fecha</label>
                                        <input type="date" required name="fecha" value="<?php echo date("Y-m-d"); ?>"
                                            class="form-control" placeholder="Fecha">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Insumos </label>
                                        <?php
                                            $sql = "SELECT id,nombre from insumos";
                                            $ejecutar = $conexion->query($sql);
                                            echo("<select  id='insumos' class='form-control'>");
                                            echo("<option value=''>Seleccione un Insumo</option>");
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
                                        <label for="exampleInputUsername1">Precio de Compra</label>
                                        <input type="number" min="0" id="precio_compra" step="0.01"
                                            pattern="^\d+(?:\.\d{1,2})?$" class="form-control" placeholder="0.00">
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
                                                <th>Precio</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="result_users">
                                        </tbody>
                                        <tfoot id="result_tot">

                                        </tfoot>
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
            $('#proveedor').select2();
            $('#insumos').select2();
            var totalfinal = 0;
            $("#add_product ").click(function () {
                id_producto = $("#insumos option:selected").val();
                product_name = $("#insumos option:selected").html();
                cantidad = parseFloat($("#cantidad").val());
                if (id_producto != "") {
                    precio_compra = parseFloat($("#precio_compra").val()).toFixed(2);
                    total = cantidad * precio_compra;
                    totalfinal = totalfinal + total;
                    $('#result_users').append('<tr>' +
                        '<td ><input type="text" required readonly name="id_producto[]" class="form-control" value="' +
                        id_producto + '">' + '</td>' +
                        '<td ><input type="text" required readonly  class="form-control" value="' +
                        product_name + '">' + '</td>' +
                        '<td ><input type="text" required readonly name="cantidad[]" class="form-control" value="' +
                        cantidad + '">' + '</td>' +
                        '<td ><input type="text" required readonly name="precio_compra[]" class="form-control" value="' +
                        precio_compra + '">' + '</td>' +
                        '<td ><input type="text" required readonly name="total[]" class="form-control" value="' +
                        total.toFixed(2) + '">' + '</td>' +
                        '</tr>'
                    );
                    $("#result_tot").empty();
                    $("#result_tot").append(
                        '<tr>' +
                        '<td COLSPAN="3" >' + '</td>' +
                        '<td ><b> Total' + '<b></td>' +
                        '<td><input type="text" required readonly name="total_compra" class="form-control" value="' +
                        totalfinal.toFixed(2) + '">'+ '</td>' +
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