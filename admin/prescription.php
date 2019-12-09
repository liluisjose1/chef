<?php include_once("./template/_header.php");?>
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
              <div class="row">
				  
                  <div class="col-md-12">
						<?php
						error_reporting(E_ALL ^ E_NOTICE);
						if ($_GET["error"] == "no") {
							echo "<div class='alert alert-primary alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Registro Exitoso";
							echo "</div>";
						} else if ($_GET["error"] == "si") {
							echo "<div class='alert alert-danger alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Error al registrar";
							echo "</div>";
						} else if ($_GET["error"] == "si_exis") {
							echo "<div class='alert alert-danger alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Error, la receta ya existe";
							echo "</div>";
						} else if ($_GET["error"] == "no_d") {
							echo "<div class='alert alert-danger alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Registro eliminado con exito";
							echo "</div>";
						} else if ($_GET["error"] == "no_up") {
							echo "<div class='alert alert-primary alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Actualizado con exito";
							echo "</div>";
						}
	
	
						?>
                  <div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Nueva Receta</h4>
								<button class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
									<i class="fa fa-plus"></i>
									Agregar
								</button>
							</div>
						</div>
						<div class="card-body">
							<!-- Modal -->
							<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h5 class="modal-title">
												<span class="fw-mediumbold">
													Nueva</span>
												<span class="fw-light">
													Receta
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="operations/receta_save.php" method="post">
												<div class="row">
													<div class="col-sm-8">
														<div class="form-group form-group-default">
															<label>Nombre de receta</label>
															<input id="nombre" name="nombre" required type="text" class="form-control" placeholder="Nombre de receta">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group form-group-default">
															<label>Precio de venta</label>
															<input id="nombre" name="precio_venta" required type="number" step="0.01"
                                            pattern="^\d+(?:\.\d{1,2})?$" class="form-control" placeholder="0.00">
														</div>
													</div>
													<div class="col-sm-7">
														<div class="form-group form-group-default">
															<label>Insumos de receta</label>
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
													<div class="col-md-3">
														<div class="form-group">
															<label for="exampleInputUsername1">Cantidad</label>
															<input type="number" min="1" class="form-control" id="cantidad" placeholder="1">
														</div>
													</div>
													<div class="col-md-1">
														<div class="form-group">
															<br>
															<button type="button" id="add_product" class="btn btn-sm btn-primary"
																title="Agregar"><span
																	class="mdi mdi-format-annotation-plus"></span></button>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="table-responsive">
														<table id="datatable-buttons" class="table" cellspacing="0"
															width="100%">
															<thead>
																<tr>
																	<th width="100">Insumo</th>
																	<th width="50">Cantidad</th>
																</tr>
															</thead>
															<tbody id="result_users">
															</tbody>
														</table>
													</div>
												</div>
										</div>
										<div class="modal-footer no-bd">
											<button type="submit" id="addRowButton" class="btn btn-primary">Guardar</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
										</div>
										</form>
									</div>
								</div>
							</div>

							<div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>Nombre</th>
											<th>Precio de Venta</th>
											<th>Fecha creación</th>
											<th>Ver</th>
											<th width="100">Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM recetas";
										$ejecutar = $conexion->query($sql);
										while ($reg = $ejecutar->fetch_assoc()) {
											echo "<tr>";
											echo "<th scope='row'>" . ($reg["id"])  . "</th>";
											echo "<td>" . ($reg["nombre"]) . "</td>";
											echo "<td>$ " . ($reg["precio_venta"]) . "</td>";
											echo "<td>" . ($reg["fecha_creacion"]) . "</td>";
											?>
											<td>
												<a name="edit" value="Delete" id="<?php echo $reg["id"]; ?>" class="btn btn-primary btn-sm view_data"><i style="color:white !important;" class='mdi mdi-file-pdf'></i></a>
											</td>
											<td>
												<a name="edit" value="Delete" id="<?php echo $reg["id"]; ?>" class="btn btn-danger btn-sm delete_data"><i style="color:white !important;" class='mdi mdi-delete'></i></a>											</tr>
										<?php  }
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                  </div>
              </div>
          </div>
<?php  include_once("./template/_footer.php") ?>
<script src="./assets/plugin/datatables/datatables.min.js"></script>
<script src="./assets/plugin/datatables/dataTables.bootstrap4.js"></script>

<script src="./assets/js/select2.js"></script>
<script src="./assets/js/select2.full.min.js"></script>
<script>
	$(document).ready(function() {
        $('#add-row').DataTable({
			"pageLength": 5,
		});
		$('.delete_data').click(function(e) {
			var user_id = $(this).attr("id");
			swal({
				title: 'Borrar?',
				icon: "warning",
				text: "Seguro que deseas borrar! ",
				type: 'warning',
				buttons: {
					confirm: {
						text: 'Si, borrar',
						className: 'btn btn-success'
					},
					cancel: {
						visible: true,
						text: 'No, cancelar',
						className: 'btn btn-danger'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					$.ajax({
						url: "operations/receta_delete.php",
						type: "POST",
						data: {
							id_user: user_id
						},
						dataType: "html",
						success: function() {
							swal("Listo!", "Borrado con exito!", "success");
							location.reload();
						},
						error: function(xhr, ajaxOptions, thrownError) {
							swal("Error al borrar!", "Intente de nuevo", "error");
						}
					});
				} else {
					swal.close();
				}
			});
		});
		function ventanaSecundaria(URL) {
		window.open(URL, "_blank", "width=400,height=600,scrollbars=NO")
		}
		$(document).on('click', '.view_data', function() {
			var id_receta = $(this).attr("id");
			ventanaSecundaria("reports/receta.php?id=" + id_receta);
		});
	});
</script>
<script>
	$(document).ready(function () {
		$('#insumos').select2();
		var totalfinal = 0;
		$("#add_product ").click(function () {
			id_producto = $("#insumos option:selected").val();
			product_name = $("#insumos option:selected").html();
			cantidad = $("#cantidad").val();
			if (id_producto != "") {
				if (cantidad!="") {
				$('#result_users').append('<tr>' +
					'<td ><input type="text" hidden name="id_producto[]" class="form-control" value="' +
					id_producto + '"><input type="text" width="100" required readonly  class="form-control col-md-9" value="' +
					product_name + '">' + '</td>' +
					'<td ><input type="text" width="100" required readonly name="cantidad[]" class="form-control col-md-3" value="' +
					cantidad + '">' +
					'</tr>'
				);
				} else {
					swal({
					icon: 'error',
					title: 'Oops...',
					text: 'Debe ingresar la cantidad de insumos!',
				})
				}

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