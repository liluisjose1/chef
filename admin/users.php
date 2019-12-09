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
								<h4 class="card-title">Nuevo Usuario</h4>
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
													Nuevo</span>
												<span class="fw-light">
													Usuario
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="operations/user_save.php" method="post">
												<div class="row">
													<div class="col-md-6 pr-0">
														<div class="form-group form-group-default">
															<label>Usuario</label>
															<input id="user" name="usuario" type="text" class="form-control" placeholder="Usuario">
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group form-group-default">
															<label>Nombre</label>
															<input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-group-default">
															<label>Tipo de usuario</label>
															<select class="form-control" name="tipo_usuario" id="tipo_usuario">
																<option value="">Seleccione una opción</option>
																<option value="1">Administrador</option>
																<option value="2">Chef</option>
																<option value="3">Mesero</option>
																<option value="4">Cajero</option>
															</select> </div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-group-default">
															<label>Estado</label>
															<select class="form-control" name="estado" id="estado">
																<option value="">Seleccione una opción</option>
																<option value="1">Activo</option>
																<option value="2">Inactivo</option>
															</select> </div>
													</div>
													<div class="col-md-12">
														<div class="form-group form-group-default">
															<label>Contraseña</label>
															<input id="contra" type="password" name="contra" class="form-control" placeholder="Contraseña"> </div>
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
													Usuario
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="operations/user_update.php" method="post">
												<div class="row">
													<div class="col-md-6 pr-0">
														<div class="form-group form-group-default">
															<label>Usuario</label>
															<input id="user1" name="usuario" type="text" class="form-control" placeholder="Usuario">
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group form-group-default">
															<label>Nombre</label>
															<input id="nombre1" name="nombre" type="text" class="form-control" placeholder="Nombre">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-group-default">
															<label>Tipo de usuario</label>
															<select class="form-control" name="tipo_usuario" id="tipo_usuario1">
																<option value="">Seleccione una opción</option>
																<option value="1">Administrador</option>
																<option value="2">Chef</option>
																<option value="3">Mesero</option>
																<option value="4">Cajero</option>
															</select> </div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-group-default">
															<label>Estado</label>
															<select class="form-control" name="estado" id="estado1">
																<option value="">Seleccione una opción</option>
																<option value="1">Activo</option>
																<option value="2">Inactivo</option>
															</select> </div>
													</div>
													<div class="col-md-12">
														<div class="form-group form-group-default">
															<label>Contraseña</label>
															<input id="contra1" type="password" name="contra" class="form-control" placeholder="Contraseña"> </div>
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
											<th>#</th>
											<th>Usuario</th>
											<th>Tipo</th>
											<th>Nombres</th>
											<th>Fecha de Creación</th>
											<th width="80">Estado</th>
											<th width="100">Acciones</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Usuario</th>
											<th>Tipo</th>
											<th>Nombres</th>
											<th>Fecha de Creación</th>
											<th width="80">Estado</th>
											<th width="100">Acciones</th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										$sql = "SELECT * FROM usuario";
										$ejecutar = $conexion->query($sql);
										$cont = 0;
										while ($reg = $ejecutar->fetch_assoc()) {
											$cont = $cont + 1;
											echo "<tr>";
											echo "<th scope='row'>" . $cont . "</th>";
											echo "<td>" . ($reg["usuario"]) . "</td>";
											if ($reg["tipo"] == 1) {
												echo "<td>Administrador</td>";
											}
											if ($reg["tipo"] == 2) {
												echo "<td>Chef</td>";
											}
											if ($reg["tipo"] == 3) {
												echo "<td>Mesero</td>";
											}
											if ($reg["tipo"] == 4) {
												echo "<td>Cajero</td>";
											}

											echo "<td><a href='#' id='" . $reg["usuario"] . "' class='edit_data' >" . ($reg["nombre"]) . "</a></td>";
											echo "<td>" . ($reg["fecha"]) . "</td>";
											if ($reg["estado"] == 1) {
												# code...
												echo "<td><span class='badge badge-success'>Activo</span></td>";
											} else {
												# code...
												echo "<td><span class='label label-inverse'>Inactivo</span></td>";
											}
											?>
											<td>
												<a name="edit" value="Delete" id="<?php echo $reg["usuario"]; ?>" class="btn btn-danger btn-sm delete_data"><i style="color:white !important;" class='mdi mdi-delete'></i></a></td>
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
						url: "operations/user_delete.php",
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
			var user_id = $(this).attr("id");
			$.ajax({
				url: "operations/user_ajax_select.php",
				method: "POST",
				data: {
					user_id: user_id
				},
				dataType: "json",
				success: function(data) {
					//console.log(data); 
					$('#user1').val(data[0]);
					$('#nombre1').val(data.nombre);
					if (data.tipo == 1) {
						$("#tipo_usuario1 option[value='1']").attr("selected", true);
					} else {
						$("#tipo_usuario1 option[value='2']").attr("selected", true);
					}
					if (data.estado == 1) {
						$("#estado1 option[value='1']").attr("selected", true);
					} else {
						$("#estado1 option[value='2']").attr("selected", true);
					}
					$('#update_user').modal('show');
				}
			});
		});
	});
</script>