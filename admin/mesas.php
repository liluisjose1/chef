<?php include_once("./template/_header.php");?>
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
								<h4 class="card-title">Agregar Nueva Mesa</h4>
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
													Nueva </span>
												<span class="fw-light">
													Mesa
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="operations/mesa_save.php" method="post">
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group form-group-default">
															<label>N. Mesa</label>
															<input  name="id" type="number" min="1" class="form-control" placeholder="1">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group form-group-default">
															<label>Capacidad</label>
															<input  name="capacidad" type="number" min="1" class="form-control" placeholder="1">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="exampleInputUsername1">Zona</label>
															<select name="zona" class="form-control" required id="">
																<option value="">Seleccione una opcion</option>
																<option value="1">Normal</option>
																<option value="2">VIP</option>
															</select>
														</div>
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
							<div class="modal fade" id="update_user" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h5 class="modal-title">
												<span class="fw-mediumbold">
													Actualizar</span>
												<span class="fw-light">
													Mesa
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="operations/mesa_update.php" method="post">
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group form-group-default">
															<label>N. Mesa</label>
															<input  name="id" id="id_mesa" type="number" min="1" class="form-control" placeholder="1">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group form-group-default">
															<label>Capacidad</label>
															<input  name="capacidad" id="capacidad" type="number" min="1" class="form-control" placeholder="1">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="exampleInputUsername1">Zona</label>
															<select name="zona" class="form-control" required id="zona">
																<option value="">Seleccione una opcion</option>
																<option value="1">Normal</option>
																<option value="2">VIP</option>
															</select>
														</div>
													</div>
												</div>
												
										</div>
										<div class="modal-footer no-bd">
											<button type="submit" id="addRowButton" class="btn btn-primary">Actualizar</button>
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
											<th>Zona</th>
											<th>Capacidad</th>
											<th>Estado</th>
											<th width="100">Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM mesas";
										$ejecutar = $conexion->query($sql);
										while ($reg = $ejecutar->fetch_assoc()) {
											echo "<tr>";
											echo "<th scope='row'>" . ($reg["id"])  . "</th>";
											$retVal = ($reg["tipo"]=='1') ? "<span class='badge badge-pill badge-success'>Normal<span>" : "<span class='badge badge-pill badge-warning'>VIP<span>" ;
											echo "<td>" . $retVal . "</td>";
											echo "<td>" . ($reg["capacidad"]) . "</td>";
											$retVal1 = ($reg["estado"]=='0') ? "<span class='badge badge-pill badge-primary'>Desocupada<span>" : "<span class='badge badge-pill badge-danger'>Ocupada<span>" ;
											echo "<td>" . $retVal1. "</td>";
											?>
											<td>
												<a name="edit" value="Delete" id="<?php echo $reg["id"]; ?>" class="btn btn-danger btn-sm delete_data"><i style="color:white !important;" class='mdi mdi-delete'></i></a>
												<a name="edit" value="Edit" id="<?php echo $reg["id"]; ?>" class="btn btn-warning btn-sm edit_data"><i style="color:white !important;" class='mdi mdi-lead-pencil'></i></a></td>
											</tr>
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
						url: "operations/mesa_delete.php",
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
		$(document).on('click', '.edit_data', function() {
			console.log("clic");
			var user_id = $(this).attr("id");
			$.ajax({
				url: "operations/mesa_ajax_select.php",
				method: "POST",
				data: {
					user_id: user_id
				},
				dataType: "json",
				success: function(data) {
					//console.log(data); 
					$('#id_mesa').val(data[0]);
					$('#zona').val(data[1]);
					$('#capacidad').val(data[2]);
					$('#update_user').modal('show');
				}
			});
		});
	});
</script>