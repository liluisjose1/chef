<?php include_once("./template/_header.php");?>
<!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
              <div class="row">
				  
                  <div class="col-md-12">
						<?php
						error_reporting(E_ALL ^ E_NOTICE);
						if ($_GET["error"] == "no") {
							echo "<div class='alert alert-success alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Pago realizado con exito, el cambio es de $ <b>$_GET[cambio]</b>";
							echo "</div>";
						} else if ($_GET["error"] == "si_x") {
							echo "<div class='alert alert-success alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Corte inicial realizado con exito";
							echo "</div>";
						} else if ($_GET["error"] == "si_z") {
							echo "<div class='alert alert-success alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Corte final realizado con exito";
							echo "</div>";
						} else if ($_GET["error"] == "si") {
							echo "<div class='alert alert-danger alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Error al registrar";
							echo "</div>";
						} else if ($_GET["error"] == "no_x") {
							echo "<div class='alert alert-danger alert-dismissable'>";
							echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
							echo "Error, ya realizo el corte inicial";
							echo "</div>";
						} 
	
	
						?>
                  <div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Caja</h4>
								<button class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#corte_caja">
									<i class="fa fa-plus"></i>
									Corte
								</button>
							</div>
						</div>
						<div class="card-body">
                        <div class="modal fade" id="corte_caja" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h5 class="modal-title">
												<span class="fw-mediumbold">
													Corte de Caja</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="operations/corte_caja.php" method="post">
												<div class="row">
												<div class="col-sm-3">
														<div class="form-group form-group-default">
															<label>Caja</label>
															<input required class="form-control" name="caja" type="number" min="1" placeholder="1" >
														</div>
                                                    </div>
                                                <div class="col-md-5">
														<div class="form-group">
															<label for="exampleInputUsername1">Tipo</label>
															<select name="tipo" class="form-control" required id="tipo">
																<option value="">Seleccione</option>
																<option value="1">CorteX</option>
																<option value="2">CorteZ</option>
															</select>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group form-group-default">
															<label>Monto</label>
															<input  name="monto" type="number" step="0.01"
                                            pattern="^\d+(?:\.\d{1,2})?$" class="form-control" placeholder="0.00">
														</div>
                                                    </div>
                                                    
												</div>
										</div>
										<div class="modal-footer no-bd">
											<button type="submit" id="addRowButton" class="btn btn-success">Guardar</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
										</div>
										</form>
									</div>
								</div>
							</div>
							<div class="modal fade" id="update_pay" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h5 class="modal-title">
												<span class="fw-mediumbold">
													Cancelar</span>
												<span class="fw-light">
													Cuenta
												</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="operations/pago_consumo.php" method="post">
												<input type="text" hidden  name="mesa" id="mesa"  >
												<input type="text" hidden  name="cliente" id="cliente"  >
												<div class="row">
													<div class="col-sm-8">
														<div class="form-group form-group-default">
															<label>Efectivo</label>
															<input  name="monto" type="number" step="0.01"
                                            pattern="^\d+(?:\.\d{1,2})?$" class="form-control" placeholder="0.00">
														</div>
													</div>
												</div>
										</div>
										<div class="modal-footer no-bd">
											<button type="submit" id="addRowButton" class="btn btn-success">Cerrar Cuenta</button>
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
											<th>Mesa</th>
											<th>Cliente</th>
											<th width="100">Generar Ticket</th>
											<th width="100">Cobrar</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT c.mesa,c.cliente FROM `cuentas` c,mesas m WHERE c.mesa=m.id AND m.estado=1 AND c.fecha=CURRENT_DATE() GROUP BY c.cliente";
										$ejecutar = $conexion->query($sql);
										while ($reg = $ejecutar->fetch_assoc()) {
											echo "<tr>";
											echo "<th scope='row'>" . ($reg["mesa"])  . "</th>";
											echo "<td>" . ($reg["cliente"]) . "</td>";
                                            ?>
                                            <td>
                                                <a name="edit" value="<?php echo $reg["mesa"]; ?>" id="<?php echo $reg["cliente"]; ?>" class="btn btn-primary btn-sm print_data"><i style="color:white !important;" class='mdi mdi-file-pdf'></i></a>
                                            </td>
											<td>
												<a name="edit" value="<?php echo $reg["mesa"]; ?>"  id="<?php echo $reg["cliente"]; ?>" class="btn btn-success btn-sm pay_provider"><i style="color:white !important;" class='mdi mdi-cash'></i></a>
                                            </td>
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
		$('.pay_provider').click(function(e) {
			var cliente = $(this).attr("id");
			var mesa = $(this).attr("value");
			$('#cliente').val(cliente);
			$('#mesa').val(mesa);
			$('#update_pay').modal('show');
		});
        $('#add-row').DataTable({
			"pageLength": 5,
		});
		function ventanaSecundaria(URL) {
		window.open(URL, "_blank", "width=400,height=600,scrollbars=NO")
		}
		$(document).on('click', '.print_data', function() {
			var cliente = $(this).attr("id");
			var mesa = $(this).attr("value");

			ventanaSecundaria("reports/ticket_consumo.php?m=" + mesa+"&c="+cliente);
		});
	});
</script>