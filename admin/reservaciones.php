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
								<h4 class="card-title">Reservaciones</h4>
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
													Reservacion
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="operations/reservacion_save.php" method="post">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label>Cliente </label>
															<?php
																$sql = "SELECT id,nombre from clientes";
																$ejecutar = $conexion->query($sql);
																echo("<select required name='cliente' id='cli' class='form-control'>");
																echo("<option value=''>Seleccione cliente</option>");
																while ($reg = $ejecutar->fetch_assoc()) {
																	echo("<option value='$reg[id]'>$reg[nombre]</option>");
																}
																echo("</select>")
															?>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="exampleInputUsername1">Lugar</label>
															<select name="espacio" class="form-control" required>
																<option value="">Seleccione</option>
																<option value="1">Salón 1</option>
																<option value="2">Salón 2</option>
																<option value="3">Salón 3</option>
																<option value="4">Salón 4</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Anticipo</label>
															<input  name="anticipo" type="number" step="0.01"
                                            pattern="^\d+(?:\.\d{1,2})?$" class="form-control" placeholder="0.00">
														</div>
                                                    </div>
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Fecha</label>
															<input  name="fecha" type="date" class="form-control">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Hora</label>
															<input  name="hora" type="time" class="form-control">
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
													Reservación
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="operations/reservacion_update.php" method="post">
												<div class="row">
													<input type="text"  hidden name="id" id="id">
													<div class="col-md-6">
														<div class="form-group">
															<label for="exampleInputUsername1">Lugar</label>
															<select name="espacio" id="espacio" class="form-control" required>
																<option value="">Seleccione</option>
																<option value="1">Salón 1</option>
																<option value="2">Salón 2</option>
																<option value="3">Salón 3</option>
																<option value="4">Salón 4</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Fecha</label>
															<input  name="fecha" id="fecha1" type="date" class="form-control">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Hora</label>
															<input  name="hora" id="hora1" type="time" class="form-control">
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
											<th>Cliente</th>
											<th>Lugar</th>
											<th>Anticipo</th>
											<th>Fecha</th>
											<th width="100">Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT r.id,c.nombre,r.espacio,r.anticipo,r.fecha FROM reservaciones r, clientes c WHERE r.id_cliente=c.id";
										$ejecutar = $conexion->query($sql);
										while ($reg = $ejecutar->fetch_assoc()) {
											echo "<tr>";
											echo "<th scope='row'>" . ($reg["id"])  . "</th>";
											echo "<td>" . ($reg["nombre"]) . "</td>";
											if ($reg["espacio"]==1) {
												echo "<td>Salon 1</td>";
											} else  if ($reg["espacio"]==2) {
												echo "<td>Salon 2</td>";
											}  else  if ($reg["espacio"]==3) {
												echo "<td>Salon 3</td>";
											}  else  if ($reg["espacio"]==4) {
												echo "<td>Salon 4</td>";
											}
											echo "<td>$ " . ($reg["anticipo"]) . "</td>";
											echo "<td>" . ($reg["fecha"]) . "</td>";
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
<script src="./assets/js/select2.js"></script>
<script src="./assets/js/select2.full.min.js"></script>
<script>
	$(document).ready(function() {
		$('#cli').select2();
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
						url: "operations/reservacion_delete.php",
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
				url: "operations/reservacion_ajax_select.php",
				method: "POST",
				data: {
					user_id: user_id
				},
				dataType: "json",
				success: function(data) {
					//console.log(data); 
					$('#id').val(data.id);
					$('#update_user').modal('show');
				}
			});
		});
	});
</script>