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
								<h4 class="card-title">Reservaciones en Linea</h4>

							</div>
						</div>
						<div class="card-body">
							
							<div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>Nombre</th>
											<th>Email</th>
											<th>Telefono</th>
											<th>Mensaje</th>
											<th>Fecha Reserva</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM reservas_online";
										$ejecutar = $conexion->query($sql);
										while ($reg = $ejecutar->fetch_assoc()) {
											echo "<tr>";
											echo "<th scope='row'>" . ($reg["id"])  . "</th>";
											echo "<td>" . ($reg["nombre"]) . "</td>";
											echo "<td><a href='mailto:$reg[email]'>" . ($reg["email"]) . "</a></td>";
											echo "<td>" . ($reg["tel"]) . "</td>";
											echo "<td>" . ($reg["mensaje"]) . "</td>";
											echo "<td>" . ($reg["fecha"]) . "</td>";
											?>
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